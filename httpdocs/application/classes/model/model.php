<?php

	/**
	 * @property int $id
	 * @property string $title
	 * @property float $price
	 * @property int $strokes
	 * @property int $seats
	 * @property float $fuel
	 * @property string $engine
	 * @property float $horsepower
	 * @property string $image
	 */
	class Model_Model extends ORM
	{
		protected $_table_name = 'models';
		protected $_sorting    = array();
		protected $_has_many   = array(
								 'vehicles' => array('model' => 'Vehicle',   'foreign_key' => 'model_id')
								 );
		public static function table()
		{
			return ORM::factory(substr(__CLASS__, 6))->_table_name;
		}
	}

?>