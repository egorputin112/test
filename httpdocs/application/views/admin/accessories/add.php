<?php echo Form::open('admin/accessories/add', array('method' => 'post')); ?>
	<table class="add-edit">
			<tbody valign="top">
				<tr>
					<td>Name</td>
					<td><?php echo Form::input('name', isset($_POST['name'])?$_POST['name']:''); ?></td>
				</tr>
				<tr>
					<td>Price</td>
					<td><?php echo Form::input('price',  isset($_POST['price'])?$_POST['price']:'',array('class'=>'small')); ?></td>
				</tr>
                <tr>
					<td>One time charge</td>
					<td><?php echo Form::select('one_time_charge',array(0=>'No',1=>'Yes'), isset($_POST['one_time_charge'])?$_POST['one_time_charge']:''); ?></td>
				</tr>
				<tr>
					<td>Inventory</td>
					<td><?php echo Form::input('inventory',  isset($_POST['inventory'])?$_POST['inventory']:'',array('class'=>'small')); ?></td>
				</tr>
			</tbody>
	</table>
	<input type="submit" value="Add"/>
<?php echo Form::close(); ?>