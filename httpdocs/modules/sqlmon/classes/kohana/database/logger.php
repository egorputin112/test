<?php

	class Kohana_Database_Logger
	{
		private $log;
		private $enabled;

		public static function instance()
		{
			static $self = null;
			if (!$self) {
				$self = new Database_Logger();
			}

			return $self;
		}

		private function __construct()
		{
			$this->reset();
		}

		public function reset($enabled = true)
		{
			$this->log     = array();
			$this->enabled = $enabled;
		}

		public function enabled($arg = null)
		{
			$res = $this->enabled;
			if (null !== $arg) {
				$this->enabled = $arg;
			}

			return $res;
		}

		public function clear()
		{
			$this->log = array();
		}

		public function add(Database_LogEntry $entry)
		{
			if ($this->enabled) {
				$this->log[] = $entry;
			}
		}

		public function getLog()
		{
			return $this->log;
		}

		private function __clone() {}
	}

?>