<?php

	class Controller_Admin_Reservations extends Controller_Admin_Template
	{
		
		public function action_index()
		{
			$orders = ORM::factory('Order')->where('till', '>', date('Y-m-d', time() - 2*86400))->find_all();
			$this->template->content = View::factory('admin/reservations/list', compact('orders'));
			$this->template->ext_files = $this->file_fetcher('list');
		}

		public function action_delete($id)
		{
			if(count($_POST) > 0){
				if(isset($_POST['confirm'])){
					ORM::factory('Order', $id)->delete();
					ORM::factory('Order_Accessory')->where('order_id', '=', $id)->delete_all();
					ORM::factory('Order_Vehicle')->where('order_id', '=', $id)->delete_all();
					$this->set_flashdata('message', 'Reservation order deleted successfully.');
				}
				$this->request->redirect('admin/reservations');
			}
			$order = ORM::factory('Order')->where('id','=',$id)->find();
			$confirmation = 'Do you surely want to delete the order (ID:'.date('Ymd', strtotime($order->from)).str_pad($order->id, 4, '0', STR_PAD_LEFT).')  from '.$order->name.' ?';
			$form_uri = 'admin/reservations/delete/'.$id;
			$this->template->content = View::factory('admin/delete', compact('confirmation','form_uri'));
		}

		public function action_edit($id)
		{
			$a  = Model_Accessory::table();
			$oa = Model_Order_Accessory::table();
			$m  = Model_Model::table();
			$v  = Model_Vehicle::table();
			$ov = Model_Order_Vehicle::table();

			$order       = ORM::factory('Order')->where('id', '=', $id)->find();
			$accessories = ORM::factory('Accessory')->select('qty')->join($oa)->on($a . '.id', '=', $oa . '.accessory_id')->where('order_id', '=', $id)->order_by('name')->find_all();
			$models      = ORM::factory('Model')->select(array('COUNT("vehicle_id")', 'qty'))
				->join($v)->on($m . '.id', '=', $v . '.model_id')
				->join($ov)->on($v . '.id', '=', $ov . '.vehicle_id')
				->where($ov . '.order_id', '=', $id)
				->group_by($v . '.model_id')
				->order_by($m . '.title')
				->find_all();
			$contact_options = array('email'=>'Email','contact'=>'Contact');
			$contact_time_options = array('Morning'=>'Morning','Afternoon'=>'Afternoon','Evening'=>'Evening');
			$this->template->ext_files = $this->file_fetcher('datepicker');
			$this->template->content = View::factory('admin/reservations/edit', compact('order', 'accessories', 'models', 'contact_options', 'contact_time_options'));
		}
		
		public function action_add()
		{
			if(count($_POST) > 0){
				$post = Validate::factory($_POST['data'])->filter(TRUE,'trim')
				                          ->rule('from','not_empty')
										  ->rule('till','not_empty')
										  ->rule('name','not_empty')
										  ->rule('address','not_empty')
										  ->rule('city','not_empty')
										  ->rule('state','not_empty')
										  ->rule('zip','not_empty')
										  ->rule('phone','not_empty')
										  ->rule('phone','phone')
										  ->rule('email','not_empty')
										  ->rule('email','email')
										  ->rule('card_type','not_empty')
										  ->rule('card_name','not_empty')
										  ->rule('card_number','not_empty')
										  ->rule('card_number','credit_card')
										  ->rule('total','not_empty');
				if($post->check()){
					if($post['from'] > $post['till'])
						$this->template->errors = array('Return date should be greater or equal to the pickup date.');
					else{
						$_POST['data']['card_exp'] = $_POST['data']['card_expmo'].'/'.$_POST['data']['card_expyr'];
						$order = ORM::factory('Order');
						$_POST['data']['is_admin'] = 1;
						$order->values($_POST['data']);
						$order_id = $order->save();
						$_POST['order_id'] = $order_id;
						if(isset($_POST['model'])){
							$taken = ORM::factory('Order_Vehicle')
									->join('orders')
									->on('orders.id', '=', 'order_vehicles.order_id')
									->where('orders.from', '<=', $post['till'])
									->where('orders.till', '>=', $post['from'])
									->find_all()
									->as_array('vehicle_id', 'vehicle_id');

							$taken = $taken ? array_values($taken) : array(0);
							foreach($_POST['model'] as $model_id=>$quantity){
								if($quantity > 0){
									$vehicles = ORM::factory('Vehicle')->where('model_id', '=', $model_id)->where('id', 'NOT IN', $taken)->limit($quantity)->find_all();
									foreach ($vehicles as $vehicle) {
										$order_vehicle = ORM::factory('Order_Vehicle');
										$order_vehicle->values(array('vehicle_id'=>$vehicle->id,'order_id'=>$order_id));
										$order_vehicle->save();
									}
								}
							}
						}
						if(isset($_POST['accessory'])){
							foreach($_POST['accessory'] as $accessory_id=>$quantity){
								if($quantity > 0){
									$order_accessory = ORM::factory('Order_Accessory');
									$order_accessory->values(array('accessory_id'=>$accessory_id,'order_id'=>$order_id,'qty'=>$quantity));
									$order_accessory->save();
								}
							}
						}
						$this->send_mail('order_confirmation',$_POST);
						if(isset($_POST['iframe'])){
							$view = '';
							$this->template->no_menu = 1;
							$this->template->message = 'Reservation order added successfully.';	
						}else{
							$this->set_flashdata('message', 'Reservation order added successfully.');
							$this->request->redirect('admin/reservations');
						}
					}
				}else
					$this->template->errors = $post->errors('admin/reservations');
			}
			if(!isset($view)){
				$view = View::factory('admin/reservations/add');
				$view->contact_time_options = array('Morning'=>'Morning','Afternoon'=>'Afternoon','Evening'=>'Evening');
				$view->contact_options = array('email'=>'Email','contact'=>'Contact');
				$view->accessories = ORM::factory('Accessory')->find_all();
				if(count($_GET) > 0 OR isset($_POST['iframe'])){
					$this->template->no_menu = 1;
					if(count($_GET) > 0){
						$_POST['data']['from'] = $_POST['data']['till'] = $_GET['date'];
						$_POST['model'][$_GET['model']] = 1;
					}
					$view->iframe = 1;
				}
				$this->template->ext_files = array($this->file_fetcher('datepicker'),$this->file_fetcher('reservations'));
			}
			$this->template->content = $view;
		}

		
		public function action_update()
		{
			$id = Arr::get($_POST, 'id');
			unset($_POST['id']);
			$order = ORM::factory('Order')->where('id', '=', $id)->find();
			$order->values($_POST);
			$order->save();
			$this->set_flashdata('message', 'Reservation order updated successfully.');
			$this->request->redirect('admin/reservations');
		}
		
		
		public function action_fetch_vehicles(){
			$this->auto_render = false;
			if(count($_POST) > 0){
				extract($_POST);
				$vehicles     = ORM::factory('Vehicle')->find_all();
				
		
				$ov    = Model_Order_Vehicle::table();
				$o     = Model_Order::table();
				$m     = Model_Model::table();
				$v     = Model_Vehicle::table();
	
				$taken = ORM::factory('Order_Vehicle')
							->join($o)
							->on($o . '.id', '=', $ov . '.order_id')
							->where($o . '.from', '<=', $till)
							->where($o . '.till', '>=', $from)
							->find_all()
							->as_array('vehicle_id', 'vehicle_id');
	
				$taken = array_values($taken);
				if (!$taken) {
					$taken = array(0);
				}
	
				$models = ORM::factory('Model')
							->select(array('COUNT("model_id")', 'qty'))
							->join($v)
							->on($m . '.id', '=', $v . '.model_id')
							->where($v . '.id', 'NOT IN', $taken)
							->group_by($m . '.id')
							->find_all();
			
				$json = array();
				foreach($models as $model){
					$json['model'][] = array('id'=>$model->id,'title'=>$model->title,'price'=>$model->price,'dropdown'=>Form::select('model['.$model->id.']',range(0,$model->qty),isset($_POST['model'][$model->id])? $_POST['model'][$model->id]:''));	
				}
				echo json_encode($json);
			}
		}
		
		public function action_view($order_id){
			$a  = Model_Accessory::table();
			$oa = Model_Order_Accessory::table();
			$m  = Model_Model::table();
			$v  = Model_Vehicle::table();
			$ov = Model_Order_Vehicle::table();
			
			$order = ORM::factory('Order')->where('id', '=', $order_id)->find();
			$view = View::factory('admin/reservations/view');
			$view->order = $order;
			$view->accessories = ORM::factory('Accessory')->select('qty')->join($oa)->on($a . '.id', '=', $oa . '.accessory_id')->where('order_id', '=', $order_id)->order_by('name')->find_all();
			$view->models      = ORM::factory('Model')->select(array('COUNT("vehicle_id")', 'qty'))
								->join($v)->on($m . '.id', '=', $v . '.model_id')
								->join($ov)->on($v . '.id', '=', $ov . '.vehicle_id')
								->where($ov . '.order_id', '=', $order_id)
								->group_by($v . '.model_id')
								->order_by($m . '.title')
								->find_all();
			
			$this->template->content = $view;
			$this->template->no_menu = 1;
			
		}
		
		function send_mail($type, $parameters){
			switch($type){
				case 'order_confirmation':
					$data = $parameters['data'];
					$data['number'] = date('Ymd', strtotime($data['till'])) . str_pad($parameters['order_id'], 4, '0', STR_PAD_LEFT);
					$models = array();
					$accessories = array();
					$have_tw = false;
					$total = 0;
					$days    = (strtotime($data['till'] . ' 00:00:00') - strtotime($data['from']. ' 00:00:00')) / 86400 + 1;
					if(isset($parameters['model'])){
						foreach ($parameters['model'] as $id => $quantity) {
							if ($quantity > 0) {
								$model = ORM::factory('Model')->where('id', '=', $id)->find();
								$entry = array(
									'id'    => $id,
									'name'  => $model->title,
									'price' => $model->price,
									'qty'   => $quantity,
									'total' => $quantity * $model->price * $days,
								);
		
								$models[] = $entry;
								$total += $entry['total'];
							}
						}
					}
					
					if(isset($parameters['accessory'])){
						foreach ($parameters['accessory'] as $id => $quantity) {
							if ($quantity > 0) {
								$accessory   = ORM::factory('Accessory')->where('id', '=', $id)->find();
								$subtotal = $quantity * $accessory->price;
								if(!$accessory->one_time_charge)
									$subtotal *= $days;
								$entry = array(
									'id'    => $id,
									'name'  => $accessory->name,
									'price' => $accessory->price,
									'qty'   => $quantity,
									'total' => $subtotal,
									'one_time_charge' => $accessory->one_time_charge
								);
		
								if ('Tow Vehicle' == $accessory->name) {
									$have_tw = true;
								}

								$accessories[] = $entry;
								$total += $entry['total'];
							}
						}
					}
					
					$vars_text = array(
						'{#name}'        => $data['name'],
						'{#email}'       => $data['email'],
						'{#address}'     => $data['address'],
						'{#city}'        => $data['city'],
						'{#state}'       => $data['state'],
						'{#zip}'         => $data['zip'],
						'{#phone}'       => $data['phone'],
						'{#time}'        => $data['time'],
						'{#requests}'    => $data['requests'],
						'{#card_type}'   => $data['card_type'],
						'{#card_number}' => $data['card_number'],
						'{#card_expmo}'  => $data['card_expmo'],
						'{#card_expyr}'  => $data['card_expyr'],
						'{#card_name}'   => $data['card_name'],
						'{#contact}'     => $data['contact'],
						'{#location}'    => URL::site(Route::get('static')->uri(array('page' => 'page-az-location')), true),
						'{#number}'      => $data['number'],
						'{#pickup}'      => date('m/d/Y', strtotime($data['from'])),
						'{#return}'      => date('m/d/Y', strtotime($data['till'])),
					);
					
					$vars_html = array_map(array('HTML', 'chars'), $vars_text);
					if ($have_tw) {
						$vars_html['{#tw_note_html}'] = Kohana::config('emails.tw_note_html');
						$vars_text['{#tw_note_text}'] = Kohana::config('emails.tw_note_text');
					}
					else {
						$vars_html['{#tw_note_html}'] = '';
						$vars_text['{#tw_note_text}'] = '';
					}
					
					$vars_html['{#order_html}'] = self::generate_order_html($models, $accessories, $days, $total, 0);
					$vars_text['{#order_text}'] = self::generate_order_text($models, $accessories, $days, $total, 0);
					
					$html = Kohana::config('emails.receipt.html');
					$text = Kohana::config('emails.receipt.text');
					$html = strtr($html, $vars_html);
					$text = strtr($text, $vars_text);
		
					$mailer = new PHPMailer();
					$mailer->ClearAllRecipients();
					$mailer->Sender = Kohana::config('emails.from_name');
					$mailer->From   = Kohana::config('emails.from_address');
					$mailer->FromName = Kohana::config('emails.from_name');
					$mailer->Subject  = Kohana::config('emails.receipt.subject');
					$mailer->CharSet  = 'utf-8';
					$mailer->Body     = $html;
					$mailer->AltBody  = $text;
					$mailer->IsHTML(true);
					$mailer->AddAddress($data['email'], $data['name']);
					$mailer->Send();
					
					$text = Kohana::config('emails.notification.text');
					$text = strtr($text, $vars_text);
					$mailer->ClearAllRecipients();
					$mailer->From   = Kohana::config('app.notify_from');
					$mailer->FromName = '';
					$mailer->Sender = Kohana::config('app.notify_from');
					$mailer->CharSet = 'utf-8';
					$mailer->Subject = Kohana::config('emails.notification.subject');
					$mailer->Body    = $text;
					$mailer->AltBody = '';
					$mailer->IsHTML(false);
					$mailer->AddAddress(Kohana::config('app.notify'));
					$mailer->Send();
				break;
			}
		}
		
		private function generate_order_html(array $models, array $accessories, $days, $total, $deposit)
		{
			return (string)View::factory('parts/order_html', array('models' => $models, 'accs' => $accessories, 'days' => $days, 'total' => $total, 'deposit' => $deposit));
		}

		private function generate_order_text(array $models, array $accessories, $days, $total, $deposit)
		{
			return (string)View::factory('parts/order_text', array('models' => $models, 'accs' => $accessories, 'days' => $days, 'total' => $total, 'deposit' => $deposit));
		}
	}

?>