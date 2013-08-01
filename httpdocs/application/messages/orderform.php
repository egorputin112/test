<?php

	return array(
		'name'        => array('not_empty' => 'Please enter your name'),
		'address'     => array('not_empty' => 'Please enter your address'),
		'city'        => array('not_empty' => 'Please enter your city'),
		'state'       => array('not_empty' => 'Please enter your state'),
		'zip'         => array('not_empty' => 'Please enter your ZIP code'),
		'phone'       => array('not_empty' => 'Please enter your phone', 'phone' => 'Phone number is incorrect'),
		'email'       => array('not_empty' => 'Please enter your email', 'email' => 'Email address is incorrect'),
		'card_type'   => array('not_empty' => 'Please specify the card type'),
		'card_number' => array('not_empty' => 'Please enter the card number', 'credit_card' => 'Card number is invalid'),
		'card_name'   => array('not_empty' => 'Please enter the cardholder name'),
		'tos'         => array('range' => 'You must accept the rental policies'),
	);

?>