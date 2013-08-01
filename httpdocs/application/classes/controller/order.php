<?php

	class Controller_Order extends Controller_Template
	{
		public $template = null;

		protected $pickup;
		protected $return;

		public function before()
		{
			$session = Session::instance();
			if ('POST' == Kohana_Request::$method) {
				$this->pickup = Arr::get($_POST, 'pickup', 0) . ' 08:00:00';
				$this->return = Arr::get($_POST, 'return', 0) . ' 17:00:00';
			}
			else {
				$this->pickup = $session->get('pickup', 0) . ' 08:00:00';
				$this->return = $session->get('return', 0) . ' 17:00:00';
			}

			$p = strtotime($this->pickup);
			$r = strtotime($this->return);
			$t = time();

			if ($p < $t || $r < $t || $p > $r) {
				$this->request->redirect(Route::get('static')->uri());
			}

			switch ($this->request->action) {
				case 'step1':
					$session->delete('order_info');
					$this->template = 'order1';
					break;

				case 'step2':
					$this->template = 'order2';
					break;

				case 'step3':
					$this->template = 'thankyou';
			}

			parent::before();

			$this->template->extra_css = '';
			$this->template->extra_js  = '';
			$this->template->pickup    = $p;
			$this->template->return    = $r;
		}

		public function action_step1()
		{
			$this->template->extra_css = HTML::style('css/jquery.css') .
			                             HTML::style('css/datepicker.css');
			$this->template->extra_js  = HTML::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js') .
			                             HTML::script('scripts/datepicker.js') .
			                             HTML::script('scripts/calendar.js');

			$vehicles     = ORM::factory('Vehicle')->find_all();
			$accessories  = ORM::factory('Accessory')->find_all();

			$pickup = date('Y-m-d', $this->template->pickup);
			$return = date('Y-m-d', $this->template->return);

			$ov    = Model_Order_Vehicle::table();
			$o     = Model_Order::table();
			$m     = Model_Model::table();
			$v     = Model_Vehicle::table();

			$taken = ORM::factory('Order_Vehicle')
			         	->join($o)
			         	->on($o . '.id', '=', $ov . '.order_id')
			         	->where($o . '.from', '<=', $return)
			         	->where($o . '.till', '>=', $pickup)
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


			$this->template->models      = $models;
			$this->template->accessories = $accessories;
		}

		public function action_step2()
		{
			$this->template->states  = Kohana::config('states')->as_array();
			$this->template->ttc     = array('Morning' => 'Morning', 'Afternoon' => 'Afternoon', 'Evening' => 'Evening');
			$this->template->contact = array('email' => 'Email', 'phone' => 'Phone');

			if ('POST' == Kohana_Request::$method) {
				$days   = (strtotime(Arr::get($_POST, 'return', 0) . ' 00:00:00') - strtotime(Arr::get($_POST, 'pickup', 0) . ' 00:00:00')) / 86400 + 1;
				$m      = (array)Arr::get($_POST, 'm');
				$a      = (array)Arr::get($_POST, 'a');
				$errors = array();
				$info   = array();
			}
			else {
				$session = Session::instance();
				$days    = (strtotime($session->get('return', 0) . ' 00:00:00') - strtotime($session->get('pickup', 0) . ' 00:00:00')) / 86400 + 1;
				$m       = (array)$session->get('m');
				$a       = (array)$session->get('a');
				$errors  = $session->get('errors', array());
				$info    = $session->get('order_info', array());
			}

			$models  = array();
			$accs    = array();
			$total   = 0;
			$deposit = 0;

			if ($m) {
				foreach ($m as $id => $qty) {
					if ($qty) {
						$model = ORM::factory('Model')->where('id', '=', $id)->find();
						$entry = array(
							'id'    => $id,
							'name'  => $model->title,
							'price' => $model->price,
							'qty'   => $qty,
							'total' => $qty * $model->price * $days,
						);

						$total   += $entry['total'];
						$deposit += Kohana::config('app.pwc_deposit') * $qty;
						$models[] = $entry;
					}
				}
			}

			if ($a) {
				foreach ($a as $id => $qty) {
					if ($qty) {
						$acc   = ORM::factory('Accessory')->where('id', '=', $id)->find();
						$subtotal = $qty * $acc->price;
						if(!$acc->one_time_charge)
							$subtotal *= $days;
						$entry = array(
							'id'    => $id,
							'name'  => $acc->name,
							'price' => $acc->price,
							'qty'   => $qty,
							'total' => $subtotal,
							'one_time_charge' => $acc->one_time_charge
						);

						$accs[] = $entry;
						$total += $entry['total'];
					}
				}
			}

			$this->template->models  = $models;
			$this->template->accs    = $accs;
			$this->template->total   = $total;
			$this->template->deposit = $deposit;
			$this->template->days    = $days;
			$this->template->errors  = $errors;
			$this->template->info    = $info;
		}

		public function action_step3()
		{
			$session = Session::instance();
			if ('POST' == Kohana_Request::$method) {
				$data = (array)Arr::get($_POST, 'data', array());
				$data['tos'] = (int)Arr::get($data, 'tos', 0);
				$model = Extreme_Model::factory('OrderForm');
				$model->values($data);

				$errors = array();
				if (!$model->check()) {
					$errors = array_values($model->validate()->errors('orderform'));
				}
				elseif (!Validate::credit_card($model->card_number, $model->card_type)) {
					$errors[] = "Card number does not match the card type";
				}

				$m = Arr::get($_POST, 'm', array());
				$a = Arr::get($_POST, 'a', array());

				$session->set('order_info', $data);
				$session->set('m', $m);
				$session->set('a', $a);
				$session->set('pickup', Arr::get($_POST, 'pickup', 0));
				$session->set('return', Arr::get($_POST, 'return', 0));
				$days     = (strtotime($session->get('return', 0) . ' 00:00:00') - strtotime($session->get('pickup', 0) . ' 00:00:00')) / 86400 + 1;

				if ($errors) {
					$session->set('errors', $errors);
					$this->request->redirect(Route::get('order')->uri(array('action' => 'step2')));
				}

				$order = ORM::factory('Order')->values($model->as_array());
				$order->from = date('Y-m-d', $this->template->pickup);
				$order->till = date('Y-m-d', $this->template->return);

				$models  = array();
				$accs    = array();
				$items   = array();
				$total   = 0;
				$deposit = 0;

				if ($m) {
					$ov    = Model_Order_Vehicle::table();
					$o     = Model_Order::table();
					$taken = ORM::factory('Order_Vehicle')
					         	->join($o)
					         	->on($o . '.id', '=', $ov . '.order_id')
					         	->where($o . '.from', '<=', $order->till)
					         	->where($o . '.till', '>=', $order->from)
					         	->find_all()
					         	->as_array('vehicle_id', 'vehicle_id');

					$taken = $taken ? array_values($taken) : array(0);

					foreach ($m as $id => $qty) {
						if ($qty) {
							$model = ORM::factory('Model')->where('id', '=', $id)->find();
							$entry = array(
								'id'    => $id,
								'name'  => $model->title,
								'price' => $model->price,
								'qty'   => $qty,
								'total' => $qty * $model->price * $days,
							);

							$total   += $entry['total'];
							$deposit += Kohana::config('app.pwc_deposit') * $qty;
							$models[] = $entry;

							$vehicles = ORM::factory('Vehicle')->where('model_id', '=', $id)->where('id', 'NOT IN', $taken)->limit($qty)->find_all();
							foreach ($vehicles as $v) {
								$x = ORM::factory('Order_Vehicle');
								$x->vehicle_id = $v->id;
								$items[] = $x;
							}
						}
					}
				}

				if ($a) {
					foreach ($a as $id => $qty) {
						if ($qty) {
							$acc   = ORM::factory('Accessory')->where('id', '=', $id)->find();
							$subtotal = $qty * $acc->price;
							if(!$acc->one_time_charge)
								$subtotal *= $days;
							$entry = array(
								'id'    => $id,
								'name'  => $acc->name,
								'price' => $acc->price,
								'qty'   => $qty,
								'total' => $subtotal,
								'one_time_charge' => $acc->one_time_charge
							);

							$x = ORM::factory('Order_Accessory')->values(array('accessory_id' => $id, 'qty' => $qty));
							if ('Tow Vehicle' == $acc->name) {
								$have_tw = true;
							}

							$accs[]  = $entry;
							$items[] = $x;
							$total  += $entry['total'];
						}
					}
				}

				$order->total = $total;
				$order->save();
				foreach ($items as &$x) {
					$x->order_id = $order->id;
					$x->save();
				}

				unset($x);

				$orderno        = date('Ymd', $this->template->pickup) . str_pad($order->id, 4, '0', STR_PAD_LEFT);
				$data['number'] = $orderno;
				$session->set('order_info', $data);

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
					'{#pickup}'      => date('m/d/Y', $this->template->pickup),
					'{#return}'      => date('m/d/Y', $this->template->return),
					'{#order_text}'  => self::generateOrderText($models, $accs, $days, $total, $deposit),
				);

				$mailer = new PHPMailer();
				$text = Kohana::config('emails.notification.text');
				$text = strtr($text, $vars_text);
				$mailer->ClearAllRecipients();
				$mailer->ClearAddresses();
				$mailer->CharSet = 'utf-8';
				$mailer->Subject = Kohana::config('emails.notification.subject');
				$mailer->Body    = $text;
				$mailer->AltBody = '';
				$mailer->IsHTML(false);
				$mailer->AddAddress(Kohana::config('app.notify'));
				$mailer->From   = Kohana::config('app.notify_from');
				$mailer->Sender = Kohana::config('app.notify_from');
				$mailer->Send();

				$this->request->redirect(URL::site(Route::get('order')->uri(array('action' => 'step3')), 'http'));
			}

			$data    = $session->get('order_info', array());
			$m       = $session->get('m', array());
			$a       = $session->get('a', array());
			$days    = (strtotime($session->get('return', 0) . ' 00:00:00') - strtotime($session->get('pickup', 0) . ' 00:00:00')) / 86400 + 1;
			$models  = array();
			$accs    = array();
			$total   = 0;
			$deposit = 0;
			$have_tw = false;

			if ($m) {
				foreach ($m as $id => $qty) {
					if ($qty) {
						$model = ORM::factory('Model')->where('id', '=', $id)->find();
						$entry = array(
							'id'    => $id,
							'name'  => $model->title,
							'price' => $model->price,
							'qty'   => $qty,
							'total' => $qty * $model->price * $days,
						);

						$total   += $entry['total'];
						$deposit += Kohana::config('app.pwc_deposit') * $qty;
						$models[] = $entry;
					}
				}
			}

			if ($a) {
				foreach ($a as $id => $qty) {
					if ($qty) {
						$acc   = ORM::factory('Accessory')->where('id', '=', $id)->find();
						$subtotal = $qty * $acc->price;
						if(!$acc->one_time_charge)
								$subtotal *= $days;
						$entry = array(
							'id'    => $id,
							'name'  => $acc->name,
							'price' => $acc->price,
							'qty'   => $qty,
							'total' => $subtotal,
							'one_time_charge' => $acc->one_time_charge
						);

						if ('Tow Vehicle' == $acc->name) {
							$have_tw = true;
						}

						$accs[] = $entry;
						$total += $entry['total'];
					}
				}
			}

			$html = Kohana::config('emails.receipt.html');
			$text = Kohana::config('emails.receipt.text');

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
				'{#pickup}'      => date('m/d/Y', $this->template->pickup),
				'{#return}'      => date('m/d/Y', $this->template->return),
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

			$vars_html['{#order_html}'] = self::generateOrderHtml($models, $accs, $days, $total, $deposit);
			$vars_text['{#order_text}'] = self::generateOrderText($models, $accs, $days, $total, $deposit);

			$html = strtr($html, $vars_html);
			$text = strtr($text, $vars_text);

			$mailer = new PHPMailer();
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

			$this->template->order   = $data;
			$this->template->models  = $models;
			$this->template->accs    = $accs;
			$this->template->total   = $total;
			$this->template->deposit = $deposit;
			$this->template->days    = $days;
			$this->template->have_tw = $have_tw;
		}

		private function generateOrderHtml(array $models, array $accs, $days, $total, $deposit)
		{
			return (string)View::factory('parts/order_html', array('models' => $models, 'accs' => $accs, 'days' => $days, 'total' => $total, 'deposit' => $deposit));
		}

		private function generateOrderText(array $models, array $accs, $days, $total, $deposit)
		{
			return (string)View::factory('parts/order_text', array('models' => $models, 'accs' => $accs, 'days' => $days, 'total' => $total, 'deposit' => $deposit));
		}
	}

?>