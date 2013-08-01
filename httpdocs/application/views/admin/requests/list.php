<table class="browse">
<?php if(count($requests) > 0):?>
	<thead>
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Subject</th>
			<th>Message</th>
			<th>Date</th>
			<th>Modify</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($requests as $request) : ?>
		<tr>
			<td><?php echo $request->name; ?></td>
			<td><?php echo $request->email; ?></td>
			<td><?php echo $request->phone; ?></td>
			<td><?php echo $request->subject; ?></td>
			<td><?php echo $request->message; ?></td>
			<td><?php echo substr($request->datetime,0,10); ?></td>
			<td><?php echo HTML::anchor('admin/requests/delete/' . $request->id,  HTML::image('images/delete.png',array('title'=>'Delete'))); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
<?php else: ?>
	<tr><td>No contact requests present.</td></tr>
<?php endif; ?>
</table>
