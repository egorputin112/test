<?php

	class Kohana_Database_SqlMon extends Kohana_Database_MySQL
	{
		public function connect()
		{
			try {
				parent::connect();

				if (!isset($this->_config['backtrace'])) {
					$this->_config['backtrace'] = true;
				}

				if (!isset($this->_config['explain'])) {
					$this->_config['explain'] = true;
				}

				if (!isset($this->_config['sqlmon'])) {
					$this->_config['sqlmon'] = true;
				}
			}
			catch (Exception $e) {
				throw $e;
			}
		}

		public function query($type, $sql, $as_object = FALSE, array $params = NULL)
		{
			if (empty($this->_config['sqlmon'])) {
				return parent::query($type, $sql, $as_object);
			}

			$entry = new Database_LogEntry();
			$entry->query = $sql;

			$start_mem  = memory_get_usage();
			$start_time = microtime(true);
			try {
				$result = parent::query($type, $sql, $as_object);
			}
			catch (Database_Exception $e) {
				$end_time = microtime(true);
				$end_mem  = memory_get_usage();

				$entry->memory   = $end_mem - $start_mem;
				$entry->time     = $end_time - $start_time;
				$entry->err_code = $this->_connection ? mysql_errno($this->_connection) : -1;
				$entry->err_msg  = $this->_connection ? mysql_error($this->_connection) : '?';
				$entry->instance = $this->_instance;
				$entry->trace    = $this->getBacktrace();

				Database_Logger::instance()->add($entry);
				throw $e;
			}

			$end_time = microtime(true);
			$end_mem  = memory_get_usage();

			$entry->instance = $this->_instance;
			$entry->trace    = $this->getBacktrace();
			$entry->memory   = $end_mem - $start_mem;
			$entry->time     = $end_time - $start_time;

			if ($this->_config['explain']) {
				$q = $sql;
				//DELETE [table] FROM tables ... => SELECT * FROM tables
				$q = preg_replace('/^(\\s*DELETE\\s.*?FROM)/ism', "SELECT * FROM\n", $q);
				//UPDATE table SET data [WHERE...] => SELECT * FROM table [WHERE...]
				if (preg_match('/^(\\s*UPDATE\\s+)/ism', $q)) {
					$q = preg_replace('/^(\\s*UPDATE\\s+)/ism', "SELECT * FROM\n", $q);
					if (preg_match('/(\\s+SET\\s+.*?WHERE)/ism', $q)) {
						$q = preg_replace('/(\\s+SET\\s+.*?WHERE)/ism', "\nWHERE\n", $q);
					}
					else {
						$q = preg_replace('/(\\s+SET\\s+.*?)/ism', "", $q);
					}
				}

				$matches = array();

				//Trying to extract SELECT from INSERT/REPLACE INTO ... AS or CREATE TABLE ... AS
				if (preg_match('/(SELECT\\s.*?FROM\\s.*$)/ism', $q, $matches)) {
					//Got SELECT, now do EXPLAIN SELECT
					$q = "EXPLAIN EXTENDED\n" . $matches[1];
					unset($matches);

					if (!empty($this->_config['profiling'])) {
						$benchmark = Profiler::start("Database ({$this->_instance})", $q);
					}

					$res = @mysql_unbuffered_query($q, $this->_connection);
					if (false !== $res) {
						isset($benchmark) and Profiler::stop($benchmark);
						$x = array();
						while (false !== ($row = mysql_fetch_assoc($res))) {
							$x[] = $row;
						}

						mysql_free_result($res);
						$entry->explain = $x;
						unset($x);
					}
					else {
						isset($benchmark) and Profiler::delete($benchmark);
					}
				}
			}

			if ($result instanceof Database_MySQL_Result) {
				$entry->rows = count($result);
			}
			elseif (is_array($result)) {
				$entry->rows = $result[1];
			}
			elseif (is_scalar($result)) {
				$entry->rows = (int)$result;
			}

			Database_Logger::instance()->add($entry);

			return $result;
		}

		private function getBacktrace()
		{
			if (empty($this->_config['backtrace'])) {
				return null;
			}

			$backtrace = debug_backtrace();
			$len       = count($backtrace);
			$where     = '';

			//The very first (zeroth) entry can be ignored - it is a call to getBacktrace()
			for ($i=1; $i<$len; ++$i) {
				if (!isset($backtrace[$i]['file'])) {
					$backtrace[$i]['file'] = '(undefined)';
				}

				if (!isset($backtrace[$i]['line'])) {
					$backtrace[$i]['line'] = '(undefined)';
				}

				if (!isset($backtrace[$i]['class'])) {
					$backtrace[$i]['class'] = '';
				}

				if (!isset($backtrace[$i]['function'])) {
					$backtrace[$i]['function'] = '';
				}

				if (defined('DOCROOT') && !strncmp(DOCROOT, $backtrace[$i]['file'], strlen(DOCROOT))) {
					$backtrace[$i]['file'] = substr($backtrace[$i]['file'], strlen(DOCROOT));
				}

				$where .= $backtrace[$i]['file'] . ', ' . $backtrace[$i]['line'];
				if ($backtrace[$i]['class'] || $backtrace[$i]['function']) {
					$where .= ' (';

					if ($backtrace[$i]['class']) {
						$where .= $backtrace[$i]['class'] . '::';
					}

					$where .= $backtrace[$i]['function'] . ')';
				}

				$where .= "\n";
			}

			$where = substr($where, 0, -1);

			if (empty($where)) {
				$where = 'undefined location';
			}

			return $where;
		}
	}

?>
