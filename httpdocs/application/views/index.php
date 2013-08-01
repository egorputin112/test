<?php require Kohana::find_file('views', 'header'); ?>
<div id="flashcontainer">
	<div id="homeimg">
		<p>
			<span>Lake Powell Jet Ski Rentals. Local, family-owned and operated for over 10 years, H2O&ndash;Zone is Lake Powell&rsquo;s &#35;1
			source for watercraft rentals and repairs offering great rates and friendly service.<br/><br/>
			At H20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in
			Page, Arizona — only moments away from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain the best personal watercraft rental service company
			in Northern Arizona!</span>
		</p>
	</div>
	<div id="homeimgrotate">
		<?php echo HTML::image('images/img_home_01.jpg', array('width' => 949, 'height' => 310, 'alt' => 'Lake Powell Jet Ski Rentals')); ?>
	</div>
	<?php echo HTML::image('images/ttl_meetfamily.png', array('class' => 'meetfamily', 'alt' => 'H2O-Zone')); ?>
	<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rates-models')), HTML::image('images/img_machines.png', array('class' => 'machines'))); ?>
</div>
<div id="promos">
	<?php echo HTML::image('images/ttl_whatshappening.gif', array('width' => 138, 'height' => 16, 'alt' => '', 'class' => 'ttlspacing')); ?>
	<div id="promoItemGroup">
		<div id="promoItem1" class="promoItem">
			<a href="<?php echo Route::get('static')->uri(array('page' => 'page-az-location')); ?>"><?php echo HTML::image('images/img_promoItem1.jpg', array('width' => 205, 'height' => 110, 'alt' => '')); ?></a><br/>
			<h3>Highway 89 Detour</h3>
			<p>Heading to Lake Powell from Phoenix, Sedona, Flagstaff or the Grand Canyon area? Make sure you plan for extra travel time!</p>
			<h3><?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'page-az-location')), 'Learn more'); ?> &raquo;</h3>
		</div>

		<div id="promoItem2" class="promoItem">
			<a href="<?php echo Route::get('static')->uri(array('page' => 'boat-rentals')); ?>"><?php echo HTML::image('images/img_promoItem2.jpg', array('width' => 205, 'height' => 110, 'alt' => '')); ?></a><br/>
			<h3>Sports Boat Rentals</h3>
			<p>Back by popular demand, we now offer sports boat rentals for your convenience.</p>
			<h3><?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'boat-rentals')), 'Learn more'); ?> &raquo;</h3>
		</div>

		<div id="promoItem3" class="promoItem">
			<a href="#"><?php echo HTML::image('images/img_promoItem3.jpg', array('width' => 205, 'height' => 110, 'alt' => '')); ?></a><br/>
			<h3>Plan Your Trip</h3>
			<p>Whether you're a seasoned regular or a first time visitor, take a moment to explore lake powell with our interactive map.</p>
			<h3><a href="#">Coming soon</a></h3>
		</div>

		<div id="CalenderControl">
			<div style="background: url('<?php echo URL::site('images/ReserveToday-Label.gif'); ?>') no-repeat 0 50%; height: 20px; width: 118px; margin: -17px 10px 8px 0; position: relative;"></div>
			<?php require Kohana::find_file('views', 'calendar'); ?>
		</div>
	</div>
</div>
<?php require Kohana::find_file('views', 'footer'); ?>
