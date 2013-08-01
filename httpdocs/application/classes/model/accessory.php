<?php

	/**
	 * @property int $id
	 * @property string $name
	 * @property float $price
	 */
	class Model_Accessory extends ORM
	{
		protected $_table_name = 'accessories';
		protected $_sorting    = array();

		public static function table()
		{
			return ORM::factory(substr(__CLASS__, 6))->_table_name;
		}
	}

?>