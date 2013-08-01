<?php

	return array(
		'from_name'    => 'H2O Zone - Lake Powell PWC Rentals',
		'from_address' => 'rent@powellzone.com',
		'tw_note_text' => 'PLEASE NOTE: Your personal watercraft will be on a trailer that requires a 2” ball for towing.',
		'tw_note_html' => '<strong>PLEASE NOTE</strong>: Your personal watercraft will be on a trailer that requires a 2” ball for towing.<br/>',
		'contact_request'=>  array(
			'subject' => 'Contact request for powellzone.com',
			'to'    => 'rent@powellzone.com'
		),
		'receipt' => array(
			'subject' => 'Reservation Confirmation',
			'html'    => 'Hello {#name},<br/><br/>

Thank You for choosing H2O Zone for your personal watercraft rental on Lake Powell.<br/>
Your confirmation number is: [<strong>{#number}</strong>]<br/>
<br/>
Your reservation is confirmed for <strong>{#pickup} - {#return}</strong>:<br/>
<br/>

{#order_html}

<br/><br/>

********************************************************************<br/>
For your convenience, here is a link to a map of our business location:
<br/>
<a href="{#location}">{#location}</a><br/>
********************************************************************<br/>
<br/>

{#tw_note_html}

Have a safe trip and we are looking forward to seeing you this summer!<br/>
<br/>

Sincerely,<br/>
Rick and Tresa Loukota<br/>
H2O-Zone, Lake Powell PWC Rentals<br/>
136 6th Ave | Page, AZ 86040<br/>
(928) 645-3121<br/>
www.powellzone.com
',
			'text'    => 'Hello {#name},

Thank You for choosing H2O Zone for your personal watercraft rental on Lake Powell.
Your confirmation number is: [{#number}]

Your reservation is confirmed for {#pickup} - {#return}:

{#order_text}


********************************************************************
For your convenience, here is a link to a map of our business location:
{#location}
********************************************************************

{#tw_note_text}

Have a safe trip and we are looking forward to seeing you this summer!

Sincerely,
Rick and Tresa Loukota
H2O-Zone, Lake Powell PWC Rentals
136 6th Ave | Page, AZ 86040
(928) 645-3121
www.powellzone.com
'
		),

		'notification' => array(
			'subject' => '[powellzone.com] New Order',
			'text'    => 'New Order @ powellzone.com: {#number}, [{#pickup} - {#return}]
Name: {#name}
Email: {#email}
Address: {#address}
City: {#city}
State: {#state}
ZIP: {#zip}
Phone: {#phone}
Best time to call: {#time}
Special requests: {#requests}
Card type: {#card_type}
Card number: {#card_number}
Expiration Date: {#card_expmo}/{#card_expyr}
Cardholder name: {#card_name}
Contact by: {#contact}

{#order_text}
',
		),
	);

?>