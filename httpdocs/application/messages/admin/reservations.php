<?php

	return array(
		'from'        => array('not_empty' => 'Pickup date is a required field'),
		'till'        => array('not_empty' => 'Return date is a required field'),
		'name'        => array('not_empty' => 'Name is a required field'),
		'address'     => array('not_empty' => 'Address is a required field'),
		'city'        => array('not_empty' => 'City is a required field'),
		'state'       => array('not_empty' => 'State is a required field'),
		'zip'         => array('not_empty' => 'Zip code is a required field'),
		'phone'       => array('not_empty' => 'Phone number is a required field', 'phone' => 'Phone number is invalid'),
		'email'       => array('not_empty' => 'Email is a required field', 'email' => 'Email address is invalid'),
		'card_type'   => array('not_empty' => 'Card type is a required field'),
		'card_number' => array('not_empty' => 'Card number is a required field', 'credit_card' => 'Card number is invalid'),
		'card_name'   => array('not_empty' => 'Cardholder name is a required field'),
		'total'   => array('not_empty' => 'Total amount is a required field')
	);

?>