<?php

	class Kohana_Database_LogEntry
	{
		public $instance;
		public $query;
		public $explain;
		public $trace;
		public $time;
		public $memory;
		public $err_code = 0;
		public $err_msg = null;
		public $rows = null;

		public function doExplain()
		{
			if (empty($this->explain)) {
				return array();
			}

			$result = array();
			foreach ($this->explain as $k => $x) {
				$x = array_map(array('HTML', 'chars'), $x);

				$select_type   = &$x['select_type'];
				$type          = &$x['type'];
				$possible_keys = &$x['possible_keys'];
				$key           = &$x['key'];
				$key_len       = &$x['key_len'];
				$ref           = &$x['ref'];
				$rows          = &$x['rows'];
				$extra         = &$x['Extra'];

				switch ($select_type) {
					case 'UNCACHEABLE SUBQUERY': $select_type = "<strong class='red'>{$select_type}</strong>"; break;
					case 'DEPENDENT SUBQUERY':   $select_type = "<span class='red'>{$select_type}</span>"; break;
				}

				switch ($type) {
					case 'ALL':             $type = "<strong class='red'>{$type}</strong>"; break;
					case 'index':           $type = "<span class='red'>{$type}</span>"; break;
					case 'system':
					case 'const':           $type = "<strong class='green'>{$type}</strong>"; break;
					case 'eq_ref':
					case 'unique_subquery': $type = "<span class='green'>{$type}</span>"; break;
					case 'ref':
					case 'ref_or_null':
					case 'fulltext':
					case 'index_subquery':  $type = "<span class='darkcyan'>{$type}</span>"; break;
					case 'range':
					case 'index_merge':     $type = "<strong class='orange'>{$type}</strong>"; break;
				}

				if (empty($key)) {
					$key = '<strong class="red">&mdash;</strong>';
				}

				if (empty($possible_keys)) {
					$possible_keys = '<strong class="red">&mdash;</strong>';
				}

				if ($key_len <= 8)       { $key_len = "<strong class='green'>{$key_len}</strong>"; }
				elseif ($key_len <= 16)  { $key_len = "<span class='green'>{$key_len}</span>"; }
				elseif ($key_len <= 32)  { $key_len = "<span class='orange'>{$key_len}</span>"; }
				elseif ($key_len <= 100) { $key_len = "<span class='red'>{$key_len}</span>"; }
				else                     { $key_len = "<strong class='red'>{$key_len}</strong>"; }

				if ($rows < 500) {}
				elseif ($rows < 1000) { $rows = "<span class='orange'>{$rows}</span>"; }
				elseif ($rows < 5000) { $rows = "<span class='red'>{$rows}</span>"; }
				else                  { $rows = "<strong class='red'>{$rows}</strong>"; }

				$e = array_map('trim', explode(';', $extra));
				if (!empty($e)) {
					foreach ($e as $thekey => $v) {
						switch ($v) {
							case 'No tables':
							case 'Not exists':
							case 'Select tables optimized away':
							case 'Impossible WHERE noticed after reading const tables':
								$v = "<strong class='green'>{$v}</strong>";
								break;

							case 'Using index':
							case 'Using index for group-by':
							case 'Using where with pushed condition':
								$v = "<span class='green'>{$v}</span>";
								break;

							case 'Distinct':
								$v = "<span class='darkcyan'>{$v}</span>";
								break;

							case 'Full scan on NULL key':
								$v = "<span class='orange'>{$v}</span>";
								break;

							case 'Using filesort':
							case 'Using temporary':
								$v = "<strong class='red'>{$v}</strong>";
								break;

							default:
								if ('Range checked for each record' == substr($v, 0, strlen('Range checked for each record'))) {
									$v = "<strong class='orange'>{$v}</strong>";
								}
						}

						$e[$thekey] = $v;
					}

					$extra = join('; ', $e);
				}

				$result[$k] = $x;
			}

			return $result;
		}
	}

?>