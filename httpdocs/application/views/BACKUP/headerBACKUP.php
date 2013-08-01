<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs</title>
	<meta name="description" content="Lake Powell Jet Ski Rentals. Local, family-owned and operated for over 10 years, H2O-Zone is Lake Powell's #1 source for watercraft rentals and repairs offering great rates and friendly service."/>
	<meta name="keywords" content="lake powell jet ski rentals, lake powell, boat rental, jet ski rental, watercraft, rental, jet ski, page, arizona, utah, glen canyon, glen canyon dam, page arizona, lake powell arizona, lake powell utah, lake powell boats, boats, powellzone, h2o zone, h20 zone, glen canyon recreation area, antelope canyon, escalante, colorado river, exploring, southwest, native american, navajo, rainbow bridge, john wesley powell"/>
	<?php echo HTML::style('css/base.css'); ?>
	<?php echo $extra_css; ?>
	<?php echo HTML::script('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js'); ?>
<!--[if lt IE 7]>
	<?php echo HTML::script('scripts/unitpngfix.js'); ?>
<![endif]-->
	<?php echo $extra_js; ?>
</head>
<body>
<script type="text/javascript">
var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-2067486-1']); _gaq.push(['_trackPageview']);
(function(){ var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true; ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s); })();
</script>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), '<span>Lake Powell Jet Ski Rentals, Boat Rentals and Watercraft Repairs</span>'); ?></h1>
		</div>
		<div id="nav">
			<ul>
				<li id="navhome"<?php if ('static' == Request::current()->controller && Request::current()->param('page') == '') : ?> class="current"<?php endif; ?>>
					<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), '<span>Home</span>'); ?>
				</li>
				<li id="navrates"<?php if ('static' == Request::current()->controller && Request::current()->param('page') == 'rates-models') : ?> class="current"<?php endif; ?>>
					<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rates-models')), '<span>Rates &amp; Models</span>'); ?>
				</li>
				<li id="navfaqs"<?php if ('static' == Request::current()->controller && Request::current()->param('page') == 'lake-powell-rental-faqs') : ?> class="current"<?php endif; ?>>
					<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rental-faqs')), '<span>Rental FAQs</span>'); ?>
				</li>
				<li id="navservices"<?php if ('static' == Request::current()->controller && Request::current()->param('page') == 'boat-services-trailer-sales') : ?> class="current"<?php endif; ?>>
					<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'boat-services-trailer-sales')), '<span>Services</span>'); ?>
				</li>
				<li id="navlocation"<?php if ('static' == Request::current()->controller && Request::current()->param('page') == 'page-az-location') : ?> class="current"<?php endif; ?>>
					<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'page-az-location')), '<span>Location</span>'); ?>
				</li>
			</ul>
		</div>
		<div id="cta">
			Make an <?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rates-models')), 'Online Reservation'); ?> (1-928-645-3121),
			or visit our <?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'page-az-location')), 'Store Location'); ?>
		</div>
	</div>
	<div id="container">
