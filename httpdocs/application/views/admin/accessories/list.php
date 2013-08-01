<table class="browse">
<?php if(count($accessories) > 0): ?>
	<thead>
		<tr>
			<th>Name</th>
			<th>Inventory</th>
			<th>Price</th>
            <th>One time charge</th>
			<th>Modify</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($accessories as $accessory) : ?>
		<tr>
			<td><?php echo $accessory->name; ?></td>
			<td><?php echo $accessory->inventory; ?></td>
			<td>$<?php echo $accessory->price; ?></td>
            <td><?php echo (($accessory->one_time_charge)? 'Yes':'No');?>
			<td><?php echo HTML::anchor('admin/accessories/edit/' . $accessory->id, HTML::image('images/edit.png',array('title'=>'Edit'))); ?>	<?php echo HTML::anchor('admin/accessories/delete/' . $accessory->id,  HTML::image('images/delete.png',array('title'=>'Delete'))); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
<?php else:?>
	<tr><td>No accessories present.</td></tr>
<?php endif; ?>
</table>
<?php echo HTML::anchor('admin/accessories/add', 'Add new accessory',array('class'=>'add')); ?>
