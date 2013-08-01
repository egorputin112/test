<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p>
			<span>Lake Powell Jet Ski and Watercraft Rentals! H2O&ndash;Zone is Lake Powell&rsquo;s &#35;1 source for watercraft rentals and repairs
			offering great rates and friendly service. Locally owned and operated for over 10 years.<br/><br/>
			At h20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in Page, Arizona -
			only moments away from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain the best personal watercraft rental service
			company in Northern Arizona!</span>
		</p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_03.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>
<div id="main-body">
	<div id="left">
		<div id="leftText">
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp;  Rates &amp; Models
			<br/><br/>
			<?php echo HTML::image('images/ttl_thankyou.gif', array('width' => 79, 'height' => 16, 'alt' => 'Rates & Models', 'class' => 'subttl')); ?>
			<br/>

			<p>An email confirmation will be sent to <?php echo HTML::chars($order['email']); ?>.</p>
			<br/>

			Hello <?php echo $order['name']; ?>,<br/><br/>

			Thank You for choosing H2O Zone for your personal watercraft rental on Lake Powell.<br/>
			Your confirmation number is: [<strong><?php echo $order['number']; ?></strong>]<br/>
			<br/>
			Your reservation is confirmed for <strong><?php echo date('m/d/Y', $pickup); ?> - <?php echo date('m/d/Y', $return); ?></strong>:<br/>
			<br/>

			<table class="order-table">
				<thead>
					<tr>
						<th class="item">Model</th>
						<th class="qty">Quantity</th>
						<th class="price">Price</th>
						<th class="total">Total</th>
					</tr>
				</thead>
				<tbody>
<?php if ($models) : ?>
	<?php foreach ($models as $m) : ?>
					<tr>
						<td class="item"><?php echo HTML::chars($m['name']); ?></td>
						<td class="qty"><?php echo Num::format($m['qty'], 0); ?></td>
						<td class="price">$<?php echo Num::format($m['price'], 2); ?><?php if ($days > 1) :?> × <?php echo $days; ?><?php endif; ?></td>
						<td class="total">$<?php echo Num::format($m['total'], 2); ?></td>
					</tr>
	<?php endforeach; ?>
<?php endif; ?>
<?php if ($accs) : ?>
	<?php foreach ($accs as $a) : ?>
					<tr>
						<td class="item"><?php echo HTML::chars($a['name']); ?></td>
						<td class="qty"><?php echo Num::format($a['qty'], 0); ?></td>
						<td class="price">$<?php echo Num::format($a['price'], 2); ?><?php if ($days > 1 AND !($a['one_time_charge'])) :?> × <?php echo $days; ?><?php endif; ?></td>
						<td class="total">$<?php echo Num::format($a['total'], 2); ?></td>
					</tr>
	<?php endforeach; ?>
<?php endif; ?>
<?php if (Kohana::config('app.pwc_deposit')) : ?>
					<tr>
						<th colspan="3" class="price">Security Deposit</th>
						<td class="total">$<?php echo Num::format($deposit, 2); ?></td>
					</tr>
<?php endif; ?>
					<tr>
						<th colspan="3" class="price">SubTotal</th>
						<td class="total">$<?php echo Num::format($total, 2); ?></td>
					</tr>
					<tr>
						<th colspan="3" class="price">Sales Tax</th>
						<td class="total">$<?php echo Num::format($total * 0.10725, 2); ?></td>
					</tr>
					<tr>
						<th colspan="3" class="price"><span style="font-weight:normal">*</span>Total Charges</th>
						<td class="total">$<?php echo Num::format($total * 1.10725, 2); ?></td>
					</tr>	
				</tbody>
			</table>

			<br/><br/>

			********************************************************************<br/>
			For your convenience, here is a link to a map of our business location:
			<br/>
			<?php echo HTML::anchor(URL::site(Route::get('static')->uri(array('page' => 'page-az-location')), true), URL::site(Route::get('static')->uri(array('page' => 'page-az-location')), true)); ?>
			<br/>
			********************************************************************<br/>
			<br/>

<?php if (!$have_tw) : ?>
			<strong>PLEASE NOTE</strong>: Your personal watercraft will be on a trailer that requires a 2” ball for towing.<br/>
<?php endif; ?>

			Have a safe trip and we are looking forward to seeing you this summer!<br/>
			<br/>

			Sincerely,
			<br/>
			Rick and Tresa Loukota <br/>
			H2O-Zone, Lake Powell PWC Rentals<br/>
			136 6th Ave | Page, AZ 86040<br/>
			(928) 645-3121<br/>
			www.powellzone.com<br/><br/>
            <!-- Google Code for Adwords Conversion Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1063492493;
var google_conversion_language = "en";
var google_conversion_format = "1";
var google_conversion_color = "ffffff";
var google_conversion_label = "vc4ICNeVpQIQjbeO-wM";
var google_conversion_value = 0;
if (200.00) {
  google_conversion_value = 200.00;
}
/* ]]> */
</script>
<script type="text/javascript" src="https://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="https://www.googleadservices.com/pagead/conversion/1063492493/?value=200.00&amp;label=vc4ICNeVpQIQjbeO-wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

		</div>
	</div>
	<div id="right">
	</div>
</div>
<?php require Kohana::find_file('views', 'footer'); ?>