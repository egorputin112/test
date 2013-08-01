<?php echo Form::open('admin/models/add', array('method' => 'post','enctype'=>'multipart/form-data')); ?>
	<table class="add-edit">
			<tbody valign="top">
							<tr>
								<td>Title</td>
								<td><?php echo Form::input('title', isset($_POST['title'])?$_POST['title']:''); ?></td>
							</tr>
							<tr>
								<td>Price</td>
								<td><?php echo Form::input('price',  isset($_POST['price'])?$_POST['price']:'',array('class'=>'small')); ?></td>
							</tr>
							<tr>
								<td>Strokes</td>
								<td><?php echo Form::input('strokes',  isset($_POST['strokes'])?$_POST['strokes']:'',array('class'=>'small')); ?></td>
							</tr>
							<tr>
								<td>Seats</td>
								<td><?php echo Form::input('seats',  isset($_POST['seats'])?$_POST['seats']:'',array('class'=>'small')); ?></td>
							</tr>
							<tr>
								<td>Fuel</td>
								<td><?php echo Form::input('fuel',  isset($_POST['fuel'])?$_POST['fuel']:'',array('class'=>'small')); ?></td>
							</tr>
							<tr>
								<td>Engine</td>
								<td><?php echo Form::input('engine',  isset($_POST['engine'])?$_POST['engine']:'',array('class'=>'small')); ?></td>
							</tr>
							<tr>
								<td>Horsepower</td>
								<td><?php echo Form::input('horsepower',  isset($_POST['horsepower'])?$_POST['horsepower']:'',array('class'=>'small')); ?></td>
							</tr>
							<tr>
								<td>Image</td>
								<td><?php echo Form::file('image'); ?></td>
							</tr>
							<tr>
								<td>No. of Vehicles</td>
								<td><?php echo Form::input('vehicles',  isset($_POST['vehicles'])?$_POST['vehicles']:'',array('class'=>'small')); ?></td>
							</tr>
			</tbody>
	</table>
	<input type="submit" value="Add"/>
<?php echo form::close(); ?>