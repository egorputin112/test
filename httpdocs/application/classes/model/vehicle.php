<?php

	/**
	 * @property int $id
	 * @property int $model_id
	 * @property Model_Model $model
	 */
	class Model_Vehicle extends ORM
	{
		protected $_table_name = 'vehicles';
		protected $_sorting    = array();
		protected $_belongs_to = array(
			'model' => array('model' => 'Model', 'foreign_key' => 'model_id'),
		);

		public static function table()
		{
			return ORM::factory(substr(__CLASS__, 6))->_table_name;
		}
	}

?>