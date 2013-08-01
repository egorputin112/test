<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p>
			<span>Lake Powell Jet Ski and Watercraft Rentals! H2O&ndash;Zone is Lake Powell&rsquo;s &#35;1 source for watercraft rentals and
			repairs offering great rates and friendly service. Locally owned and operated for over 10 years.<br/><br/>
			At H20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in Page,
			Arizona — only moments away from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain
			the best personal watercraft rental service company in Northern Arizona!</span>
		</p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_04.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>
<div id="main-body">
	<div id="left">
		<div id="leftText" style="padding-right:0px;">
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp; Sports Boat Rentals<br/><br/>
			<?php echo HTML::image('images/ttl_boatrentals.gif', array('width' => 163, 'height' => 16, 'alt' => '', 'class' => 'subttl')); ?>
<div class="MiddleColumn">

<div class="PhotoGalleryColumn">
	<div id="PhotoGallery">
			<a href="images/boatgallery/boat_05.jpg" rel="BoatGallery" title="image1">
				<?php echo HTML::image('images/boatgallery/SportsBoatThumb.jpg', array('width' => 238, 'height' => 205, 'alt' => '')); ?>

				<?php echo HTML::image('images/viewGalleryButton.jpg', array('width' => 134, 'height' => 21, 'alt' => '', 'class' => 'ViewGalleryButton')); ?>
			</a>
			
			<span style="display:none">
				<a href="images/boatgallery/boat_02.jpg" rel="BoatGallery" title="image2"><?php echo HTML::image('images/gallery-thumbnail.jpg', array('width' => 231, 'height' => 123, 'alt' => '')); ?></a>
				<a href="images/boatgallery/boat_03.jpg" rel="BoatGallery" title="image3"><?php echo HTML::image('images/gallery-thumbnail.jpg', array('width' => 231, 'height' => 123, 'alt' => '')); ?></a>
				<a href="images/boatgallery/boat_04.jpg" rel="BoatGallery" title="image4"><?php echo HTML::image('images/gallery-thumbnail.jpg', array('width' => 231, 'height' => 123, 'alt' => '')); ?></a>
				<a href="images/boatgallery/boat_01.jpg" rel="BoatGallery" title="image5"><?php echo HTML::image('images/gallery-thumbnail.jpg', array('width' => 231, 'height' => 123, 'alt' => '')); ?></a>
			</span>
	</div>
</div>

<div class="ContentColumn">
<h6>Monterey 180FS Sport Boat</h6>
<p>The 180FS might be the smallest model in the Monterey line up, but size is only a measurement. The 7-foot 8-inch beam makes for a spacious cockpit and comfortable ride. This exciting model comes standard with an extended swim platform and air assist chine making it an ideal boat for water sports. The 180FS is full of amenities ready for a day on Lake Powell!
			<br /><br/>
			<strong>Daily Rate</strong>: $350 (3 day minimum)<br />
			  <strong>Weekly Rate</strong>: $1950<br />
			  <em>Save 10% when you combine with a watercraft rental</em><br />
              <br />
		    Call <strong>(928) 645-3121</strong> for reservations and availability.<br/><strong>Features</strong>:<br />
Wakeboard tower, bolster seat, sun shade and swim deck<br />
<br />
<strong>Horsepower</strong>: 225<br />
<strong>Top Speed</strong>: 50mph<br />
<strong>Fuel</strong>: 28 Gallons<br />
<strong>Seats</strong>: 8 </p>
</div>

</div>
			
		</div>
	</div>
	<div id="right">
		<div id="rightTextProduct">

			<div id="highlight">
				<strong>Pickup Time</strong>: 8:00 a.m.<br/>
				<strong>Return Time</strong>: 5:00 p.m.
			</div>
			<br/>
			<strong>Rentals Include</strong>:
			<div class="customBullets">
				<ul>
					<li>Trailer</li>
					<li>Life Jackets</li>
					<li>Gas Cans</li>
				</ul>
			</div>

			<p>
				<strong>Fuel: </strong>
				All rentals are full when you pick them up. To avoid extra charges, fill your rental with unleaded fuel before returning.
			</p>
			<p>
				<strong>Transporting:</strong>
				Due to NPS regulations, you must launch and retrieve the rental equipment yourself. For your convenience,
				we rent vehicles capable of towing. More information and rates are available when you make your
				online reservation.
			</p>
			<p>
				<strong>Safety:</strong>
				Operating and safety instructions are provided before departure.
			</p>
			<p>
				<strong>Operator Requirements</strong>:
				Federal and State (Arizona or Utah) boating laws apply on the waters of Lake Powell.
				For more information, visit our <?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rental-faqs')), 'Rental FAQs'); ?> page.
			</p>
			<p>
				<strong>Life Jackets</strong>: Life jackets are provided with rental for no additional charge.
			</p>
			<p>
				<strong>Gas Cans</strong>: Gas cans are provided with rental for no additional charge.
			</p>
		</div>
		<div id="rightPromo"><?php echo HTML::image('images/promo_coastguard.gif', array('width' => 216, 'height' => 72, 'alt' => '')); ?>
	</div>
	<br style="clear: both"/>
</div>

<?php echo HTML::script('scripts/jquery.colorbox-min.js'); ?>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
	$("a[rel='BoatGallery']").colorbox();
});

</script>


<?php require Kohana::find_file('views', 'footer'); ?>
