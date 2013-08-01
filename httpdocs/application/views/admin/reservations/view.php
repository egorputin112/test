<table class="view">
		<tbody valign="top">
			<tr>
				<td>
					<table>
						<tbody valign="top">
							<tr>
								<th>Pickup</th>
								<td><?php echo $order->from; ?></td>
							</tr>
							<tr>
								<th>Return</th>
								<td><?php echo $order->till; ?></td>
							</tr>
							<tr>
								<th>Name</th>
								<td><?php echo $order->name; ?></td>
							</tr>
							<tr>
								<th>Address</th>
								<td><?php echo $order->address; ?></td>
							</tr>
							<tr>
								<th>City</th>
								<td><?php echo $order->city; ?></td>
							</tr>
							<tr>
								<th>State</th>
								<td><?php echo $order->state; ?></td>
							</tr>
							<tr>
								<th>Zip</th>
								<td><?php echo $order->zip; ?></td>
							</tr>
							<tr>
								<th>Phone</th>
								<td><?php echo $order->phone; ?></td>
							</tr>
							<tr>
								<th>Time to Contact</th>
								<td><?php echo $order->time; ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $order->email; ?></td>
							</tr>
							<tr>
								<th>Requests</th>
								<td><?php echo $order->requests; ?></td>
							</tr>
							<tr>
								<th>Card Type</th>
								<td><?php echo HTML::chars($order->card_type); ?></td>
							</tr>
							<tr>
								<th>Cardholder</th>
								<td><?php echo HTML::chars($order->card_name); ?></td>
							</tr>
							<tr>
								<th>Card #</th>
								<td><?php echo HTML::chars($order->card_number); ?></td>
							</tr>
							<tr>
								<th>Expiration</th>
								<td><?php echo HTML::chars($order->card_exp); ?></td>
							</tr>
							<tr>
								<th>Contact</th>
								<td><?php echo $order->contact; ?></td>
							</tr>
							<tr>
								<th>Total</th>
								<td>$<?php echo $order->total; ?></td>
							</tr>
						</tbody>
					</table>
				</td>
				<?php if (count($models) OR count($accessories)) : ?>
				<td>
					<?php if (count($models)):?>
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
					<?php endif;?>
					<?php if (count($accessories)):?>
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
					<?php endif;?>
				</td>
				<?php endif; ?>
			</tr>
		</tbody>
</table>
