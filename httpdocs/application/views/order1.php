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

			<?php echo Form::open(URL::site(Route::get('order')->uri(array('action' => 'step2')), 'https')); ?>
				<?php echo Form::hidden('pickup', date('Y-m-d', $pickup)); ?>
				<?php echo Form::hidden('return', date('Y-m-d', $return)); ?>
				<h3 style="padding-top: 0">
					Vehicles Available <?php echo date('D, d M Y', $pickup); ?> — <?php echo date('D, d M Y', $return); ?>
				</h3>
				<span class="change" style="color: #DE783E; cursor: pointer; text-decoration: underline;">Change Dates</span>

<?php foreach ($models as $model) : ?>
				<div id="product">
					<div id="productLeft">
						<a href="<?php echo URL::site('images/products/' . $model->image); ?>"><?php echo HTML::image('images/products/' . $model->image, array('width' => 410, 'height' => 141, 'alt' => $model->title)); ?></a>
					</div>
					<div id="productRight">
						<h3><?php echo HTML::chars($model->title); ?></h3>
						<?php echo HTML::image('images/products/price_' . $model->price . '.gif', array('width' => 67, 'height' => 67, 'alt' => "\${$model->price} per day", 'class' => 'price')); ?>
						<?php echo HTML::chars($model->strokes); ?>-Stroke<br/>
						Horsepower: <?php echo HTML::chars($model->horsepower); ?><br/>
						Engine: <?php echo HTML::chars($model->engine); ?><br/>
						Fuel: <?php echo HTML::chars($model->fuel); ?> Gallons<br/>
						Seats: <?php echo HTML::chars($model->seats); ?><br/>
						<?php echo Form::label('qty_' . $model->id, 'Qty:'); ?>
						<?php echo Form::select("m[{$model->id}]", range(0, $model->qty), 0, array('id' => 'qty_' . $model->id)); ?>
						<?php echo Form::image('', '', array('src' => 'images/btn_booknow.gif', 'style' => 'float: right')); ?>
					</div>
				</div>
<?php endforeach; ?>

				<h3>Accessories</h3>

				<table id="accessories">
					<tbody>
<?php foreach ($accessories as $x) : ?>
						<tr>
							<th scope="row"><?php echo Form::label('a' . $x->id, $x->name); ?></th>
							<td>$<?php echo $x->price; if(!$x->one_time_charge) echo '/day';?></td>
							<td><?php echo Form::input("a[{$x->id}]", 0, array('id' => 'a' . $x->id, 'size' => 3)); ?></td>
						</tr>
<?php endforeach; ?>
					</tbody>
				</table>
				<p>
					<?php echo Form::image('', '', array('src' => 'images/btn_booknow.gif')); ?>
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
<div id="dialog">
	<?php require Kohana::find_file('views', 'calendar'); ?>
</div>
<script type="text/javascript">
jQuery(
	function($)
	{
		$('#dialog').dialog({ resizable : false, autoOpen : false, modal : true, title : 'Change Date' });
		$('span.change').click(function() { $('#dialog').dialog('open'); });
	}
);
</script>
<?php require Kohana::find_file('views', 'footer'); ?>
