<?php

	return array(
		'discover' => array(
			'length' => '16',
			'prefix' => '6(?:5|011)',
			'luhn'   => true,
		),

		'mastercard' => array(
			'length' => '16',
			'prefix' => '5[1-5]',
			'luhn'   => true,
		),

		'visa' => array(
			'length' => '13,16',
			'prefix' => '4',
			'luhn'   => true,
		),
	);

?>