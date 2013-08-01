<?php

	/**
	 * @property int $id
	 * @property int $order_id
	 * @property int $vehicle_id
	 * @property Model_Order $order
	 * @property Model_Vehicle $vehicle
	 */
	class Model_Order_Vehicle extends ORM
	{
		protected $_table_name = 'order_vehicles';
		protected $_sorting    = array();
		protected $_belongs_to = array(
			'order' => array('model' => 'Order',   'foreign_key' => 'order_id'),
			'model' => array('model' => 'Vehicle', 'foreign_key' => 'vehicle_id'),
		);

		public static function table()
		{
			return ORM::factory(substr(__CLASS__, 6))->_table_name;
		}
	}

?>