<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p>
			<span>Lake Powell Jet Ski and Watercraft Rentals! h20&ndash;Zone is Lake Powell&rsquo;s &#35;1 source for watercraft rentals and repairs
			offering great rates and friendly service. Locally owned and operated for over 10 years.<br/><br/>
			At h20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in Page, Arizona — only moments away
			from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain the best personal watercraft rental service company
			in Northern Arizona!</span>
		</p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_02.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>

<div id="main-body">
	<div id="left">
		<div id="leftText">
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp; Services
			<br/><br/>
			<?php echo HTML::image('images/ttl_services.gif', array('width' => 69, 'height' => 16, 'alt' => 'Services', 'class' => 'subttl')); ?>
			<br/>

			H2O-Zone is your source for Marine and Personal Watercraft Repairs.
			<strong>Free estimates available.</strong>

			<h3>Marine Tune-Up</h3>

			Inspection and servicing of all components is vital to the operation of your watercraft!
			Tune-ups are recommended every 30 hours of riding time. Tune-up includes:

			<div class="customBullets">
				<ul>
					<li>Replacing spark plugs</li>
					<li>Engine Compression Test</li>
					<li>Grease PTO (Power TakeOff)</li>
					<li>Carburetor Adjustment</li>
				</ul>
			</div>

			<h3>Carburetor Adjustments</h3>

			<p>
				Did you know that elevation effects the performance of your PWC? If you want the highest levels of efficiency and speed
				from your machine, a carburetor adjustment is recommended!
			</p>

			<h3>Jet Pump Service</h3>
			<p>
				SeaDoo PWC&rsquo;s and Boats are required to have jet pump serviced on a regular basis.
				SeaDoo Jet Pumps have a sealed, oil-filled impeller shaft which requires a pressure test and oil change every 30 to 50 hours.
				Failure to have this service performed regularly results in costly repairs.
			</p>

			<h3>Hydro Lock Removal</h3>

			<p>
				Hydrostatic lock, hydraulic lock or hydro lock occurs when liquids, typically water, enter an engine cylinder.
				You can hydro lock a PWC engine by flipping or sinking a machine in the waters and then cranking the engine several times
				trying to start the engine. This process will bring water up the exhaust system filling the crankcase with water.
				Because water does not compress, the engine becomes locked up. The best way to remove a hydro lock is to take it
				to a qualified service center to have it properly removed. If not handled properly, water ingestion will cause
				internal corrosion which results in premature engine failure.<br/><br/>

				A hydro lock removal on a 4-stroke may vary in time and may take as long as 3 hours for this service.
				This is because the engine oil has to be removed 2-3 times to get the water out of the crankcase.
			</p>

			<h3>Winterization</h3>

			<p>
				In cold climates, it is recommended to winterize all watercraft. Winterization is the process of removing water
				from cylinder block and exhaust system to prevent freezing. This process also includes fogging cylinders with oil
				to prevent corrosion and rust, along with disabling the electrical system to prevent starting until ready to Dewinterize.
			</p>

			<h3>Dewinterization</h3>

			<p>
				Dewinterization is the process of enabling the electrical system, charging the battery, running a compression test on engine,
				and test firing to ensure an easy start all summer long.
			</p>

			<h3>Carburetor Rebuilds</h3>

			<p>
				Marine Carburetor rebuilds for boats and personal watercraft vary depending on application.
				Kit charges and replacement parts will apply.
			</p>

			<h3>Engine Rebuilds</h3>

			<p>Major engine rebuilds are available for all watercraft, including Personal Watercraft.</p>

			<h3>Other</h3>

			<p>Repairs and diagnosis are available for all PWC makes and models.  Down time varies depending on availability of parts.</p>
		</div>
	</div>
	<div id="right">
		<div id="rightTextProduct">
			<div id="highlight"><h5>Hourly Rate: $95/hr</h5></div>

			<div class="customBullets">
				<ul>
					<li><strong>Marine Tune-Up</strong>: 1 Hour*</li>
					<li><strong>Carburetor Adjustments</strong>: Varies</li>
					<li><strong>Jet Pump Service</strong>: 1.5 Hours*</li>
					<li><strong>Hydro Lock Removal</strong>: 2 – 3 Hours*</li>
					<li><strong>Winterization</strong>: 1 Hour*</li>
					<li><strong>Dewinterization</strong>: 1 Hour*</li>
					<li><strong>Carburetor Rebuilds</strong>: Varies</li>
					<li><strong>Engine Rebuilds</strong>: Varies</li>
					<li><strong>Other Repairs</strong>: Varies</li>
				</ul>

				<div id="highlight" style="margin: 15px 0"><?php echo HTML::image('images/logo_shorelander.gif', array('width' => 168, 'height' => 37, 'alt' => '')); ?></div>
				ShoreLand&rsquo;r goes above and beyond the competition in a number of key areas.
				These all add up to a trailer you can depend on year in and year out.
				A trailer that will look better, last longer and go farther.
				Get the most out of every weekend and every summer vacation.
				Get a ShoreLand’r and go the extra mile!
			</div>
		</div>
	</div>
	<br style="clear: both"/>
</div>

<?php require Kohana::find_file('views', 'footer'); ?>
