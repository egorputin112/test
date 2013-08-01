<?php

	/**
	 * @property int $id
	 * @property int $order_id
	 * @property int $accessory_id
	 * @property int $qty
	 * @property Model_Order $order
	 * @property Model_Accessory $accessory
	 */
	class Model_Order_Accessory extends ORM
	{
		protected $_table_name = 'order_accessories';
		protected $_sorting    = array();
		protected $_belongs_to = array(
			'order'     => array('model' => 'Order',     'foreign_key' => 'order_id'),
			'accessory' => array('model' => 'Accessory', 'foreign_key' => 'accessory_id'),
		);

		public static function table()
		{
			return ORM::factory(substr(__CLASS__, 6))->_table_name;
		}
	}

?>