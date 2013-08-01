<table class="order-table">
	<thead>
		<tr>
			<th align="left">Item</th>
			<th align="right">Price</th>
			<th align="right">Quantity</th>
			<th align="right">Total</th>
		</tr>
	</thead>
	<tbody>
<?php if ($models) : ?>
	<?php foreach ($models as $m) : ?>
		<tr>
			<td align="left"><?php echo HTML::chars($m['name']); ?></td>
			<td align="right">$<?php echo Num::format($m['price'], 2); ?><?php if ($days > 1) :?> × <?php echo $days; ?><?php endif; ?></td>
			<td align="right"><?php echo Num::format($m['qty'], 0); ?></td>
			<td align="right">$<?php echo Num::format($m['total'], 2); ?></td>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
<?php if ($accs) : ?>
	<?php foreach ($accs as $a) : ?>
		<tr>
			<td align="left"><?php echo HTML::chars($a['name']); ?></td>
			<td align="right">$<?php echo Num::format($a['price'], 2); ?><?php if ($days > 1 AND !$a['one_time_charge']) :?> × <?php echo $days; ?><?php endif; ?></td>
			<td align="right"><?php echo Num::format($a['qty'], 0); ?></td>
			<td align="right">$<?php echo Num::format($a['total'], 2); ?></td>
		</tr>
	<?php endforeach; ?>
<?php endif; ?>
<?php if (Kohana::config('app.pwc_deposit')) : ?>
		<tr>
			<th colspan="3" align="right">Security Deposit</th>
			<td align="right">$<?php echo Num::format($deposit, 2); ?></td>
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
