<?php echo Form::open('admin/reservations/add', array('method' => 'post')); ?>
<?php if(isset($iframe)) echo Form::hidden('iframe',1);?>
	<table class="add-edit">
		<tbody valign="top">
			<tr>
				<td>
					<table>
						<tbody valign="top">
							<tr>
								<td>Pickup</td>
								<td><?php echo Form::input('data[from]', isset($_POST['data']['from'])?$_POST['data']['from']:'',array('class'=>'datepicker','id'=>'from')); ?></td>
							</tr>
							<tr>
								<td>Return</td>
								<td><?php echo Form::input('data[till]',  isset($_POST['data']['till'])?$_POST['data']['till']:'',array('class'=>'datepicker','id'=>'till')); ?></td>
							</tr>
							<tr>
								<td>Name</td>
								<td><?php echo Form::input('data[name]',  isset($_POST['data']['name'])?$_POST['data']['name']:''); ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><?php echo Form::input('data[address]',  isset($_POST['data']['address'])?$_POST['data']['address']:''); ?></td>
							</tr>
							<tr>
								<td>City</td>
								<td><?php echo Form::input('data[city]',  isset($_POST['data']['city'])?$_POST['data']['city']:''); ?></td>
							</tr>
							<tr>
								<td>State</td>
								<td><?php echo Form::select('data[state]', Kohana::config('states')->as_array(),  isset($_POST['data']['state'])?$_POST['data']['state']:'',array('class'=>'long')); ?></td>
							</tr>
							<tr>
								<td>Zip</td>
								<td><?php echo Form::input('data[zip]',  isset($_POST['data']['zip'])?$_POST['data']['zip']:''); ?></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><?php echo Form::input('data[phone]',  isset($_POST['data']['phone'])?$_POST['data']['phone']:''); ?></td>
							</tr>
							<tr>
								<td>Time to Contact</td>
								<td><?php echo Form::select('data[time]',$contact_time_options,  isset($_POST['data']['time'])?$_POST['data']['time']:'',array('class'=>'long')); ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo Form::input('data[email]',  isset($_POST['data']['email'])?$_POST['data']['email']:''); ?></td>
							</tr>
							<tr>
								<td>Requests</td>
								<td><?php echo Form::textarea('data[requests]',  isset($_POST['data']['requests'])?$_POST['data']['requests']:''); ?></td>
							</tr>
							<tr>
								<td>Card Type</td>
								<td>
									<label><?php echo Form::radio('data[card_type]', 'visa', ((isset($_POST['data']['card_type']) AND $_POST['data']['card_type'] == 'visa') OR count($_POST) == 0)? TRUE:FALSE); ?> Visa</label>
									<label><?php echo Form::radio('data[card_type]', 'mastercard',  ((isset($_POST['data']['card_type']) AND $_POST['data']['card_type'] == 'mastercard'))? TRUE:FALSE); ?> MasterCard</label>
									<label><?php echo Form::radio('data[card_type]', 'discover', ((isset($_POST['data']['card_type']) AND $_POST['data']['card_type'] == 'discover'))? TRUE:FALSE); ?> Discover</label>
								</td>
							</tr>
							
							<tr>
								<td>Card #</td>
								<td><?php echo Form::input('data[card_number]',  isset($_POST['data']['card_number'])?$_POST['data']['card_number']:''); ?></td>
							</tr>
                            <tr>
								<td>Cardholder</td>
								<td><?php echo Form::input('data[card_name]',  isset($_POST['data']['card_name'])?$_POST['data']['card_name']:''); ?></td>
							</tr>
							<tr>
								<td>Expiration</td>
								<td>
								<?php echo Form::select('data[card_expmo]', Date::months(), isset($_POST['data']['card_expmo'])?$_POST['data']['card_expmo']:'',array('class'=>'expmo')); ?>
								/
								<?php echo Form::select('data[card_expyr]', Date::years(date('Y'), date('Y') + 7), isset($_POST['data']['card_expyr'])?$_POST['data']['card_expyr']:'',array('class'=>'expyr')); ?>
								</td>
							</tr>
							<tr>
								<td>Contact</td>
								<td><?php echo Form::select('data[contact]', $contact_options,  isset($_POST['data']['contact'])?$_POST['data']['contact']:'', array('class'=>'long')); ?></td>
							</tr>
							<tr>
								<td>Total</td>
								<td><?php echo Form::input('data[total]',  isset($_POST['data']['total'])?$_POST['data']['total']:'',array('id'=>'total')); ?></td>
							</tr>
						</tbody>
					</table>
				</td>
				<td>
					<table>
						<tr class="bold">
							<td>Accessories</td><td>Price</td><td>Quantity</td>
						</tr>
						<?php if(count($accessories) > 0):
									foreach($accessories as $accessory):
									?>
									<tr>
										<td><?php echo $accessory->name; ?></td><td>$<?php echo $accessory->price; ?></td><td><?php echo Form::input('accessory['.$accessory->id.']',isset($_POST['accessory'][$accessory->id])? $_POST['accessory'][$accessory->id]:'0',array('class'=>'small','rel'=>$accessory->one_time_charge)); ?></td>
									</tr>
									<?php	
									endforeach;	
						      endif; ?>
					</table>
				</td>
				<td id="models">
				
				</td>
			</tr>
		</tbody>
	</table>
	<input type="submit" value="Add"/>
<?php echo form::close(); ?>
<?php if(isset($_POST['model'])){
				$models = '';
				foreach($_POST['model'] as $key=>$value){
					if(!empty($models))
						$models .= '&';
					$models .= 'model['.$key.']='.$value;
				}
				echo '<script>models=\''.$models.'\';</script>';
	  }
?>
