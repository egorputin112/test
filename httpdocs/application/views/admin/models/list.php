<table class="browse">
<?php if(count($models) > 0): ?>
	<thead>
		<tr>
			<th>Model</th>
			<th>Inventory</th>
			<th>Price</th>
			<th>Strokes</th>
			<th>Seats</th>
			<th>Fuel</th>
			<th>Engine</th>
			<th>Horsepower</th>
			<th>Modify</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($models as $model) : ?>
		<tr>
			<td>
				<?php echo HTML::image('images/products/' . $model->image, array('class'=>'model', 'alt' => $model->title)); ?> <br/>
				<?php echo $model->title; ?>
			</td>
			<td><?php echo count($model->vehicles->find_all()); ?></td>
			<td>$<?php echo $model->price; ?></td>
			<td><?php echo $model->strokes; ?></td>
			<td><?php echo $model->seats; ?></td>
			<td><?php echo $model->fuel; ?></td>
			<td><?php echo $model->engine; ?></td>
			<td><?php echo $model->horsepower; ?></td>
			<td><?php echo HTML::anchor('admin/models/edit/' . $model->id, HTML::image('images/edit.png',array('title'=>'Edit'))); ?>	<?php echo HTML::anchor('admin/models/delete/' . $model->id,  HTML::image('images/delete.png',array('title'=>'Delete'))); ?></td>
		</tr>
<?php endforeach; ?>
	</tbody>
<?php else:?>
	<tr><td>No models present.</td></tr>
<?php endif; ?>
</table>
<?php echo HTML::anchor('admin/models/add', 'Add new model',array('class'=>'add')); ?>
