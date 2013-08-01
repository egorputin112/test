<?php

	abstract class Extreme_Model extends Model
	{
		protected $_validate  = null;
		protected $_rules     = array();
		protected $_callbacks = array();
		protected $_filters   = array();
		protected $_labels    = array();

		protected $_properties = array();
		protected $_object = array();

		public function as_array()
		{
			return $this->_object;
		}

		public function values(array $data)
		{
			if ($data) {
				foreach ($data as $key => $value) {
					$this->__set($key, $value);
				}
			}

			return $this;
		}

		public function __get($key)
		{
			$k = array_search($key, $this->_properties);
			if (false !== $k) {
				return Arr::get($this->_object, $key, null);
			}

			throw new Kohana_Exception('The :property property does not exist in the :class class', array(':property' => $key, ':class' => get_class($this)));
		}

		public function __set($key, $value)
		{
			$k = array_search($key, $this->_properties);
			if (false !== $k) {
				$this->_object[$key] = $value;
				return;
			}

			throw new Kohana_Exception('The :property property does not exist in the :class class', array(':property' => $key, ':class' => get_class($this)));
		}

		public function __isset($key)
		{
			return false !== array_search($key, $this->_properties);
		}

		public function __unset($key)
		{
			$k = array_search($key, $this->_properties);
			if (false !== $k) {
				$this->_object[$key] = null;
			}
		}

		public function __sleep()
		{
			return array('_object');
		}

		public function __wakeup()
		{
			if (is_string($this->_db)) {
				$this->_db = Database::instance($this->_db);
			}
		}

		public function check()
		{
			if (!$this->_validate) {
				$this->_validate();
			}
			else {
				$this->_validate->exchangeArray($this->as_array());
			}

			if ($this->_validate->check()) {
				$this->_object = array_merge($this->_object, $this->_validate->getArrayCopy());
				return true;
			}

			return false;
		}

		public function validate()
		{
			if (!$this->_validate) {
				$this->_validate();
			}

			return $this->_validate;
		}

		protected function _validate()
		{
			$this->_validate = Validate::factory($this->_object);

			foreach ($this->_rules as $field => $rules) {
				$this->_validate->rules($field, $rules);
			}

			foreach ($this->_filters as $field => $filters){
				$this->_validate->filters($field, $filters);
			}

			foreach ($this->_labels as $field => $label) {
				$this->_validate->label($field, $label);
			}

			foreach ($this->_callbacks as $field => $callbacks) {
				foreach ($callbacks as $callback) {
					if (is_string($callback)) {
						if ('self->' == substr($callback, 0, 6) && method_exists($this, substr($callback, 6))) {
							$this->_validate->callback($field, array($this, substr($callback, 6)));
						}
						elseif ('self::' == substr($callback, 0, 6) && method_exists($this, substr($callback, 6))) {
							$this->_validate->callback($field, array(get_class($this), substr($callback, 6)));
						}
						else {
							$this->_validate->callback($field, $callback);
						}
					}
					else {
						$this->_validate->callback($field, $callback);
					}
				}
			}
		}
	}

?>