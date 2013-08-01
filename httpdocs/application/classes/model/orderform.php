<?php

	class Model_OrderForm extends Extreme_Model
	{
		protected $_db = null;

		protected $_properties = array(
			'name', 'address', 'city', 'state', 'zip', 'phone', 'time', 'email',
			'requests', 'card_type', 'card_number', 'card_expmo', 'card_expyr',
			'card_name', 'contact', 'tos'
		);

		protected $_filters = array(
			true         => array('trim' => null),
			'tos'        => array('intval' => null),
			'card_expmo' => array('intval' => null),
			'card_expyr' => array('intval' => null),
		);

		protected $_rules = array(
			'name'        => array('not_empty' => null),
			'address'     => array('not_empty' => null),
			'city'        => array('not_empty' => null),
			'state'       => array('not_empty' => null),
			'zip'         => array('not_empty' => null),
			'phone'       => array('not_empty' => null),
			'email'       => array('not_empty' => null, 'email' => null),
			'card_type'   => array('not_empty' => null),
			'card_number' => array('not_empty' => null, 'credit_card' => null),
			'card_name'   => array('not_empty' => null),
			'tos'         => array('range' => array(1, 1)),
		);

		public function as_array()
		{
			$result = parent::as_array();
			$result['card_number'] = substr($result['card_number'], 0, 6) . '...' . substr($result['card_number'], -4);
			$result['card_exp']    = $result['card_expyr'] . '/' . $result['card_expmo'];
			unset($result['tos'], $result['card_expyr'], $result['card_expmo']);

			return $result;
		}
	}

?>