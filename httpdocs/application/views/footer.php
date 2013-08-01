		</div>
	</div>
	<div class="push"></div>
	<div id="footerwrap" class="footer">
		<div id="globalfooter">
			<p class="reserve pad">
				Make an
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rates-models')), 'Online Reservation'); ?>
				(1-928-645-3121), or visit our Lake Powell
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'page-az-location')), 'Store Location'); ?>.
			</p>

			<p class="right">
				<?php echo HTML::anchor('', 'Home'); ?> |
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'our-company')), 'Our Company'); ?> |
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'site-map')), 'Site Map'); ?> |
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'contact-us')), 'Contact Us'); ?>
			</p>

			<p class="social">
				<a href="http://www.facebook.com/powellzone" target="_blank"><?php echo HTML::image('images/FB-Logo.gif', array('width' => 69, 'height' => 14, 'alt' => 'Facebook')); ?>&nbsp;</a>&nbsp;&nbsp;<a href="http://www.twitter.com/powellzone" target="_blank"><?php echo HTML::image('images/TT-Logo.gif', array('width' => 59, 'height' => 14, 'alt' => 'Twitter')); ?>&nbsp;</a>
			</p>

			<p class="copy">
				Copyright &copy; <?php echo date('Y'); ?> H2O-Zone, Inc. All rights reserved.
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'terms-of-use')), 'Terms of Use'); ?> |
				<?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'privacy-policy')), 'Privacy Policy'); ?>
			</p>

			<p class="right padtop">Company and product names mentioned are trademarks of their respective companies.</p>
		</div>
	</div>
</body>
</html>