<?php

	/**
	 * @property int $id
	 * @property string $from
	 * @property string $till
	 * @property string $name
	 * @property string $address
	 * @property string $city
	 * @property string $state
	 * @property string $zip
	 * @property string $phone
	 * @property string $time
	 * @property string $email
	 * @property string $requests
	 * @property string $card_type
	 * @property string $card_number
	 * @property string $card_name
	 * @property string $card_exp
	 * @property string $contact
	 * @property float $total
	 * @property Model_Order_Vehicle $vehicles
	 * @property Model_Order_Accessory $accessories
	 */
	class Model_Order extends ORM
	{
		protected $_table_name = 'orders';
		protected $_sorting    = array();
		protected $_has_many   = array(
			'vehicles'    => array('model' => 'Order_Vehicle',   'foreign_key' => 'order_id'),
			'accessories' => array('model' => 'Order_Accessory', 'foreign_key' => 'order_id'),
		);

		public static function table()
		{
			return ORM::factory(substr(__CLASS__, 6))->_table_name;
		}
	}

?>