<table id="tbl" class="browse">
<?php if(count($orders) > 0): ?>
	<thead>
		<tr>
			<th>Order ID</th>
			<th>Order Date</th>
			<th>Name</th>
			<th>Pickup</th>
			<th>Return</th>
			<th>Accessories </th>
			<th>Modify</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($orders as $x) : ?>
		<tr>
			<td><?php echo date('Ymd', strtotime($x->from)) . str_pad($x->id, 4, '0', STR_PAD_LEFT); ?></td>
			<td><?php echo substr($x->order_date,0,10); ?></td>
			<td><?php echo HTML::chars($x->name); ?></td>
			<td><?php echo HTML::chars($x->from); ?></td>
			<td><?php echo HTML::chars($x->till); ?></td>
			<td><?php if(count($x->accessories->find_all()) > 0) echo 'Yes';else echo 'No'; ?></td>
			<td><?php echo HTML::anchor('admin/reservations/edit/' . $x->id, HTML::image('images/edit.png',array('title'=>'Edit'))); ?>	<?php echo HTML::anchor('admin/reservations/delete/' . $x->id,  HTML::image('images/delete.png',array('title'=>'Delete'))); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
<?php else:?>
	<tr><td>No orders present.</td></tr>
<?php endif; ?>
</table>
<?php echo HTML::anchor('admin/reservations/add', 'Add new reservation',array('class'=>'add')); ?>
