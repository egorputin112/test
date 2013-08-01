<?php require Kohana::find_file('views', 'header'); ?>
<div id="subcontainer">
	<div id="subimg">
		<p>
			<span>Lake Powell Jet Ski and Watercraft Rentals! h30&ndash;Zone is Lake Powell&rsquo;s &#35;1 source for watercraft rentals
			and repairs offering great rates and friendly service. Locally owned and operated for over 10 years.<br/><br/>
			At h20-Zone, we always have a wide variety of equipment available for rent with rates to serve every lifestyle.
			Our equipment is carefully inspected and serviced to ensure they are ready for you! Our shop is located in
			Page, Arizona — only moments away from beautiful Lake Powell.<br/><br/>
			Drop by, give us a call or make your reservation online and you'll see why we remain the best
			personal watercraft rental service company in Northern Arizona!</span>
		</p>
	</div>
	<div id="subimgrotate"><?php echo HTML::image('images/img_subpage_01.jpg', array('width' => 949, 'height' => 195, 'alt' => '')); ?></div>
</div>
<div id="main-body">
	<div id="left">
		<div id="leftText">
			<?php echo HTML::anchor(Route::get('static')->uri(array('page' => '')), 'Home'); ?> &nbsp;&gt;&nbsp;  Rates &amp; Models
			<br/><br/>
			<?php echo HTML::image('images/ttl_ratesmodels.gif', array('width' => 122, 'height' => 16, 'alt' => 'Rates & Models', 'class' => 'subttl')); ?>

<?php if ($errors) : ?>
			<div class="errors">
				<ul>
	<?php foreach ($errors as $error) : ?>
					<li><?php echo $error; ?></li>
	<?php endforeach; ?>
				</ul>
			</div>
<?php endif; ?>

			<?php echo Form::open(Route::get('order')->uri(array('action' => 'step3'))); ?>
				<?php echo Form::hidden('pickup', date('Y-m-d', $pickup)); ?>
				<?php echo Form::hidden('return', date('Y-m-d', $return)); ?>

				<h3>Your Order</h3>

				Pickup date: <strong><?php echo date('m/d/Y', $pickup); ?></strong><br/>
				Return date: <strong><?php echo date('m/d/Y', $return); ?></strong><br/><br/>

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
							<td class="price">$<?php echo Num::format($a['price'], 2); ?><?php if ($days > 1 AND !$a['one_time_charge']) :?> × <?php echo $days; ?><?php endif; ?></td>
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

				<table id="order2">
					<tbody>
						<tr><th colspan="2"><?php echo HTML::image('images/formtitle_1.gif', array('width' => 106, 'height' => 10, 'alt' => 'Renter Information')); ?></th></tr>
						<tr>
							<td align="right" width="174">Name</td>
							<td><?php echo Form::input('data[name]', Arr::get($info, 'name')); ?></td>
						</tr>
						<tr>
							<td align="right">Address</td>
							<td><?php echo Form::input('data[address]', Arr::get($info, 'address')); ?></td>
						</tr>
						<tr>
							<td align="right">City</td>
							<td><?php echo Form::input('data[city]', Arr::get($info, 'city')); ?></td>
						</tr>
						<tr>
							<td align="right">State</td>
							<td><?php echo Form::select('data[state]', $states, Arr::get($info, 'state')); ?></td>
						</tr>
						<tr>
							<td align="right">Zip Code</td>
							<td><?php echo Form::input('data[zip]', Arr::get($info, 'zip')); ?></td>
						</tr>
						<tr>
							<td align="right">Phone</td>
							<td><?php echo Form::input('data[phone]', Arr::get($info, 'phone')); ?></td>
						</tr>
						<tr>
							<td align="right">Best Time to Call</td>
							<td><?php echo Form::select('data[time]', $ttc, Arr::get($info, 'time')); ?></td>
						</tr>
						<tr>
							<td align="right">Email</td>
							<td><?php echo Form::input('data[email]', Arr::get($info, 'email')); ?></td>
						</tr>
					</tbody>
					<tbody>
						<tr><th colspan="2"><?php echo HTML::image('images/formtitle_5.gif', array('width' => 92, 'height' => 11, 'alt' => 'Special Requests')); ?></th></tr>
						<tr>
							<td colspan="2"><?php echo Form::textarea('data[requests]', Arr::get($info, 'requests'), array('cols' => 60, 'rows' => 4)); ?></td>
						</tr>
					</tbody>
					<tbody>
						<tr><th colspan="2"><?php echo HTML::image('images/formtitle_4.gif', array('width' => 108, 'height' => 10, 'alt' => 'Reservation Deposit')); ?></th></tr>
						<tr>
							<td align="right">Card Type</td>
							<td>
								<label><?php echo Form::radio('data[card_type]', 'visa', 'visa' == Arr::get($info, 'card_type')); ?> Visa</label>
								<label><?php echo Form::radio('data[card_type]', 'mastercard', 'mastercard' == Arr::get($info, 'card_type')); ?> MasterCard</label>
								<label><?php echo Form::radio('data[card_type]', 'discover', 'discover' == Arr::get($info, 'card_type')); ?> Discover</label>
							</td>
						</tr>
						<tr>
							<td align="right">Card Number</td>
							<td><?php echo Form::input('data[card_number]', Arr::get($info, 'card_number')); ?></td>
						</tr>
						<tr>
							<td align="right">Expires</td>
							<td>
								<?php echo Form::select('data[card_expmo]', Date::months(), Arr::get($info, 'card_expmo')); ?>
								/
								<?php echo Form::select('data[card_expyr]', Date::years(date('Y'), date('Y') + 7), Arr::get($info, 'card_expyr')); ?>
							</td>
						</tr>
						<tr>
							<td align="right">Name on Card</td>
							<td><?php echo Form::input('data[card_name]', Arr::get($info, 'card_name')); ?></td>
						</tr>
					</tbody>
					<tbody>
						<tr><th colspan="2"><?php echo HTML::image('images/formtitle_6.gif', array('width' => 82, 'height' => 10, 'alt' => 'Rental Policies')); ?></th></tr>
						<tr>
							<td colspan="2">
								<p>
									All reservations are held with a Visa, MasterCard or Discover card number. A one-day rental fee
									per reserved watercraft will be charged if a cancellation occurs 7 days or less prior to reservation date.
									Your credit card will be charged for the entire rental period if a "no-show" or "cancellation"
									occurs the day of the reservation.
								</p>
<?php if (Kohana::config('app.pwc_deposit')) : ?>
								<p>
									A damage deposit of $<?php echo Num::format(Kohana::config('app.pwc_deposit'), 2); ?> is required for each personal watercraft rented. This deposit will be charged
									the day of pickup and will be returned to you when the machine is returned undamaged.
								</p>
<?php endif; ?>
								<p>
									<strong>You will receive an email confirmation at the email address provided above.</strong>
								</p>
							</td>
						</tr>
					</tbody>
					<tbody>
						<tr><td colspan="2"><br/></td></tr>
						<tr>
							<td align="right">Preferred Method of Contact</td>
							<td><?php echo Form::select('data[contact]', $contact, Arr::get($info, 'contact')); ?></td>
						</tr>
						<tr>
							<td align="right">I have read and understand the rental policies</td>
							<td><?php echo Form::checkbox('data[tos]', 1, !!Arr::get($info, 'tos')); ?></td>
						</tr>
					</tbody>
				</table>

				<p>
					<?php echo Form::image('', 'Submit Reservation', array('alt' => 'Submit Reservation', 'src' => 'images/btn_submitorder.gif')); ?>
<?php if ($models) : ?>
	<?php foreach ($models as $m) : ?>
					<?php echo Form::hidden("m[{$m['id']}]", $m['qty']); ?>
	<?php endforeach; ?>
<?php endif; ?>
<?php if ($accs) : ?>
	<?php foreach ($accs as $a) : ?>
					<?php echo Form::hidden("a[{$a['id']}]", $a['qty']); ?>
	<?php endforeach; ?>
<?php endif; ?>
				</p>
			<?php echo Form::close(); ?>
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
				All rentals are full when you pick them up. To avoid extra charges, fill your rental with unleaded fuel before being returned.
			</p>
			<p>
				<strong>Transporting:</strong>
				You are responsible for transporting rentals to and from Lake Powell (6 miles away) — courtesy vehicles are available for $45.
			</p>
			<p>
				<strong>Safety:</strong>
				Operating and safety instructions are provided before departure.
			</p>
			<p>
				<strong>Operating Requirement</strong>:
				Federal and State (Arizona or Utah) boating laws apply on the waters of Lake Powell.
				For more information, visit our <?php echo HTML::anchor(Route::get('static')->uri(array('page' => 'rental-faqs')), 'Rental FAQs'); ?> page.
			</p>
			<p>
				<strong>Life Jackets</strong>: Life jackets are provided with rental for no addtional charge.
			</p>
			<p>
				<strong>Gas Cans</strong>: Gas cans are provided with rental for no additional charge.
			</p>
		</div>
		<div id="rightPromo"><?php echo HTML::image('images/promo_coastguard.gif', array('width' => 216, 'height' => 72, 'alt' => '')); ?></div>
	</div>
	<br style="clear: both"/>
</div>
<?php require Kohana::find_file('views', 'footer'); ?>
