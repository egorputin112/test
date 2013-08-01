<?php echo Form::open('admin/reservations/update', array('method' => 'post')); ?>
	<?php echo Form::hidden('id', $order->id); ?>
	<table class="add-edit">
		<tbody valign="top">
			<tr>
				<td>
					<table>
						<tbody valign="top">
							<tr>
								<td>Pickup</td>
								<td><?php echo Form::input('from', $order->from,array('class'=>'datepicker')); ?></td>
							</tr>
							<tr>
								<td>Return</td>
								<td><?php echo Form::input('till', $order->till,array('class'=>'datepicker')); ?></td>
							</tr>
							<tr>
								<td>Name</td>
								<td><?php echo Form::input('name', $order->name); ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?php echo Form::input('address', $order->address); ?></td>
							</tr>
							<tr>
								<td>City</td>
								<td><?php echo Form::input('city', $order->city); ?></td>
							</tr>
							<tr>
								<td>State</td>
								<td><?php echo Form::select('state', Kohana::config('states')->as_array(), $order->state, array('class'=>'long')); ?></td>
							</tr>
							<tr>
								<td>Zip</td>
								<td><?php echo Form::input('zip', $order->zip); ?></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><?php echo Form::input('phome', $order->phone); ?></td>
							</tr>
							<tr>
								<td>Time to Contact</td>
								<td><?php echo Form::select('time', $contact_time_options, $order->time, array('class'=>'long')); ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo Form::input('email', $order->email); ?></td>
							</tr>
							<tr>
								<td>Requests</td>
								<td><?php echo Form::textarea('requests', $order->requests); ?></td>
							</tr>
							<tr>
								<td>Card Type</td>
								<td><?php echo HTML::chars($order->card_type); ?></td>
							</tr>
							<tr>
								<td>Cardholder</td>
								<td><?php echo HTML::chars($order->card_name); ?></td>
							</tr>
							<tr>
								<td>Card #</td>
								<td><?php echo HTML::chars($order->card_number); ?></td>
							</tr>
							<tr>
								<td>Expiration</td>
								<td><?php echo HTML::chars($order->card_exp); ?></td>
							</tr>
							<tr>
								<td>Contact</td>
								<td><?php echo Form::select('contact', $contact_options, $order->contact, array('class'=>'long')); ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td><?php echo Form::input('total', $order->total); ?></td>
							</tr>
						</tbody>
					</table>
				</td>
<?php if (count($models)) : ?>
				<td>
					<table class="bordered">
						<caption>Vehicles</caption>
						<tbody>
<?php foreach ($models as $x) : ?>
							<tr>
								<th><?php echo HTML::chars($x->title); ?></th>
								<td><?php echo Num::format($x->qty, 0); ?></td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</td>
<?php endif; ?>
<?php if (count($accessories)) : ?>
				<td>
					<table class="bordered">
						<caption>Accessories</caption>
						<tbody>
<?php foreach ($accessories as $x) : ?>
							<tr>
								<th><?php echo HTML::chars($x->name); ?></th>
								<td><?php echo Num::format($x->qty, 0); ?></td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</td>
<?php endif; ?>
			</tr>
		</tbody>
	</table>
	<input type="submit" value="Update"/>
<?php echo form::close(); ?>
<script>
	$(document).ready(function(){
		$(".datepicker").datepicker({dateFormat:'yy-mm-dd'});
	});
</script>