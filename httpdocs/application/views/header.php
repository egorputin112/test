<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php
		//Added by EDY 16 JUN 2011 - Edit <meta> and <title> dynamically
		$Edescription = "Lake Powell Jet Ski Rentals. Local, family-owned and operated for over 10 years, H2O-Zone is Lake Powell's #1 source for watercraft rentals and repairs offering great rates and friendly service.";
		$Ekeywords = "lake powell jet ski rentals, lake powell, boat rental, jet ski rental, watercraft, rental, jet ski, page, arizona, utah, glen canyon, glen canyon dam, page arizona, lake powell arizona, lake powell utah, lake powell boats, boats, powellzone, h2o zone, h20 zone, glen canyon recreation area, antelope canyon, escalante, colorado river, exploring, southwest, native american, navajo, rainbow bridge, john wesley powell";	
		switch(Request::current()->param('page'))
		{
			case "rates-models" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Rates" ; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "rental-faqs" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Rental FAQ"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "boat-services-trailer-sales" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Services"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "page-az-location" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Location"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "our-company" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Our Company"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "boat-rentals" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Boat Rentals"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "site-map" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Site Map"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "terms-of-use" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Term Of Use"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			case "privacy-policy" :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs - Privacy Policy"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
				
			default :
				$Etitle = "Lake Powell Jet Ski Rentals | Boat Rentals | Watercraft Repairs"; // change here for different title
				$Edescription = $Edescription; // change here for different description
				$Ekeywords = $Ekeywords; //change here for different keywords
				break;
			
		}
?>
	<?php echo '<title>'. $Etitle  . '</title>'; ?>

	<?php echo '<meta name="description" content="' . $Edescription . '"/>'; ?>
	
	<?php echo '<meta name="keywords" content="' . $Ekeywords . '"/>'; ?>
	
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
