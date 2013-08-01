<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p><span>Boat Rentals Lake Powell</span></p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_01.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>
<div id="main-body">
	<div id="left">
		<div id="leftText">
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp;  Store Location
            <br/><br/>
			<?php echo HTML::image('images/ttl_storelocation.gif', array('width' => 119, 'height' => 16, 'alt' => 'Location', 'class' => 'subttl')); ?>
		</div>

		<div id="map" style="width: 620px; height: 350px"></div>

		<div id="leftText">
		  <div style="border:1px solid #df783e; background:#f3f4f8; padding:10px; margin-top:20px"><h2 class="detour">Highway 89 Detour</h2>
            Make sure you <strong>plan for extra travel time</strong> if you are traveling to Lake Powell from Flagstaff/Grand Canyon. The detour is about <strong>45 miles longer</strong> than the direct route.<br/><br/>
            <a href="http://www.azdot.gov/us89" target="_blank">US 89 Closed South of Page Due to Landslide</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.azdot.gov/Index_Docs/Headlines/pdf/13-072_Map_US89_Closure_proof3.pdf" target="_blank">Download a Detour Map</a></div>
    		<h2><span>Driving directions</span></h2>
			<h3>If you are traveling from Flagstaff/Grand Canyon<strong> (Highway 89)</strong></h3>
			<ol>
	            <li>Head north on <strong>US-89 N</strong> toward Page/Lake Powell</li>
	            <li><strong style="color:#de783e">Detour :</strong> Turn <strong>right</strong> onto <strong>US-160 E</strong> toward Tuba City</li>
				<li><strong style="color:#de783e">Detour : </strong> Turn <strong>left</strong> onto <strong>AZ-98 W</strong> toward Kayenta</li>
				<li>Turn <strong>right</strong> onto <strong>Coppermine Rd</strong></li>
				<li>Turn <strong>right</strong> onto <strong>S Lake Powell Blvd</strong></li>
				<li>Turn <strong>left</strong> onto <strong>S Navajo Dr</strong></li>
				<li>Take the first <strong>right</strong> onto <strong>6th Ave</strong></li>
				<li>H2O-Zone will be on the <strong>left</strong></li>
			</ol>

			<h3>If you are traveling  from Las Vegas/Kanab <strong>(Highway 89)</strong></h3>
			<ol>
				<li>Pass over the Glen Canyon Dam</li>
				<li>Turn <strong>left</strong> onto <strong>N Lake Powell Blvd</strong></li>
				<li>Turn <strong>right</strong> onto <strong>Elm St</strong></li>
				<li>Turn <strong>left</strong> onto <strong>6th Ave</strong></li>
				<li>H2O-Zone will be on the <strong>right</strong></li>
			</ol>

			<h3>If you are traveling from Kayenta <strong>(Highway 98)</strong></h3>
			<ol>
				<li>Turn <strong>right</strong> onto <strong>Coppermine Rd</strong></li>
				<li>Turn <strong>right</strong> onto <strong>S Lake Powell Blvd</strong></li>
				<li>Turn <strong>left</strong> onto <strong>S Navajo Dr</strong></li>
				<li>Take the first <strong>right</strong> onto <strong>6th Ave</strong></li>
				<li>H2O-Zone will be on the <strong>left</strong></li>
			</ol>
		</div>
	</div>
	<div id="right">
		<?php include('parts/contact-right.php'); ?>
</div>

		<div id="facebook">
			<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like-box href="http://www.facebook.com/powellzone" height="287" width="282" show_faces="true" stream="false" header="false"></fb:like-box>
		</div>
	</div>
	<br style="clear: both"/>
</div>
<?php require Kohana::find_file('views', 'footer'); ?>