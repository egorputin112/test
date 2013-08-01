<?php

	/**
	 * @author Vladimir Kolesnikov <vladimir@extrememember.com>
	 */
	class ORM extends Kohana_ORM
	{
		protected $_my_alias;

		protected $_reload_on_wakeup = false;

		/**
		 * Extends Kohana_ORM::factory() by providing the ability to pass an arbitrary number of the arguments to the created model.
		 * This is very useful for Prospects model which spans across several tables
		 *
		 * @param string $model
		 * @param mixed $id
		 * @return ORM
		 */
		public static function factory($model, $id = null)
		{
			$args = func_get_args();
			$name = array_shift($args);

			$model = 'Model_' . $model;
			$model = new ReflectionClass($model);

			return $model->newInstanceArgs($args);
		}

		/**
		 * Kohana::list_columns() extended with caching support
		 *
		 * @return array
		 */
		public function list_columns()
		{
			$key = "ORM Column Cache: " . $this->_object_name;
			$result = Kohana::cache($key, null, 7200);
			if (null === $result) {
				$result = parent::list_columns();
				Kohana::cache($key, $result, 7200);
			}

			return $result;
		}

		/**
		 * @todo Does not work with "has many through"
		 * @param ORM $self
		 * @param string $path
		 */
		protected function _build_joins(ORM $self, $path)
		{
			$tables = array_merge($self->_has_many, $self->_has_one);
			if ($tables) {
				foreach ($tables as $name => $x) {
					if (isset($x['nocascade'])) {
						continue;
					}

					$params = array($x['model'], null);
					if (isset($x['params'])) {
						$params = array_merge($params, $x['params']);
					}

					$model = call_user_func_array(array('ORM', 'factory'), $params);
					if (isset($x['through'])) {
						$through = ORM::factory($x['through']);
						$this->_db_builder
							->join($through->_table_name, 'LEFT')
							->on($through->_table_name . '.' . $x['far_key'], '=', $model->_table_name.'.'.$model->_primary_key)
							->join($model->_table_name, 'LEFT')
							->on($through->_table_name . '.' . $x['foreign_key'], '=', $self->_table_name . '.' . $self->_primary_key)
							->delete_table($model->_table_name);
					}
					else {
						$alias = $path . $name;
						$this->_db_builder
							->join(array($model->_table_name, $alias), 'LEFT')
							->on($alias . '.' . $x['foreign_key'], '=', $self->_my_alias . '.' . $self->_primary_key)
							->delete_table($alias);

						$model->_my_alias = $alias;
					}

					if (!empty($x['where'])) {
						foreach ($x['where'] as $y) {
							$this->_db_builder->on($alias . '.' . $y[0], $y[1], $y[2]);
						}
					}

					$this->_build_joins($model, $path . $name . ':');
					$model->_my_alias = null;
				}
			}

		}

		/**
		 * @return ORM
		 */
		public function cascaded_delete()
		{
			$this->_build(Database::DELETE);
			$this->_my_alias = $this->_table_name;
			$this->_build_joins($this, '');
			$this->_db_builder->delete_table($this->_table_name);
			$this->_my_alias = null;
//			echo $this->_db_builder->compile($this->_db), "\n";
			$this->_db_builder->execute($this->_db);
			return $this->clear();
		}
	}

?>