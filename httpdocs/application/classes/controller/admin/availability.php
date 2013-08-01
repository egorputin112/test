<?php

	class Controller_Admin_Availability extends Controller_Admin_Template
	{
	
		public function action_index()
		{
			$curr_month = date('m');
			$curr_year = date('Y');
			$curr_month_days = cal_days_in_month(CAL_GREGORIAN,$curr_month,$curr_year);
			$monthly_end_date = $curr_year.'-'.$curr_month.'-'.$curr_month_days;
			$monthly_start_date = date('Y-m-d',strtotime($curr_year.'-'.$curr_month.'-1')-86400);
			
			$monthly_data = $this->populate_data($monthly_start_date, $monthly_end_date, 1);

			$weekly_end_date = date('Y-m-d');
			$weekly_start_date = date('Y-m-d',strtotime("-1 week"));
			$weekly_data = $this->populate_data($weekly_start_date, $weekly_end_date);
			
			$monthly_call = 'offset=1&monthly=1&date='.date('Y-m-d',strtotime($monthly_start_date)-86400);
			$weekly_call = 'offset=1&date='.date('Y-m-d',strtotime($weekly_start_date)-86400);
			
			$this->template->content = View::factory('admin/availability/index', compact('monthly_data','weekly_data','monthly_call','weekly_call'));
			$this->template->ext_files = array($this->file_fetcher('tabs'),$this->file_fetcher('availability'),$this->file_fetcher('prettyphoto'),$this->file_fetcher('tooltip'));
		}
		
		function populate_data($start_date, $end_date, $monthly=0, $as_array=0){
			$days = (strtotime($end_date)-strtotime($start_date))/86400;
			$data = array();
			$data['orders'] = array();
			for($i=1; $i<=$days; $i++){
				$date = date('Y-m-d',strtotime($start_date) + (86400 * $i));
				$orders = ORM::factory('Order')->where('from','<=',$date)->where('till','>=',$date)->find_all();
				
				foreach($orders as $order){
					$vehicles = $order->vehicles->find_all();
					foreach($vehicles as $vehicle)
					  	$data['orders'][$date][$vehicle->vehicle_id] = array('name'=>$order->name,'id'=>$order->id,'is_admin'=>$order->is_admin);
				}
				$data['dates'][] = array('day'=>date('l',strtotime($date)),'date'=>$date);
			}
			$models = ORM::factory('Model')->find_all();
			foreach($models as $model){
				$data['models'][$model->id] = array('title'=>$model->title,'price'=>$model->price);
				$vehicles = $model->vehicles->find_all();
				foreach($vehicles as $vehicle)
					$data['models'][$model->id]['vehicles'][] = $vehicle->id;
			}
			if($monthly){
				$data['title'] = date('F Y',strtotime($end_date));
			}else{
				$data['title'] = 'Weekly '.(date('Y-m-d',strtotime($start_date) +86400)).' / '.$end_date;
			}
			if($as_array)
				return $data;
			return json_encode($data);
		}
		
		public function action_fetch_data(){
			$this->auto_render = false;
			if(count($_POST) > 0){
				$offset = $_POST['offset'];
				$date = $_POST['date'];
				$monthly = isset($_POST['monthly']) ? 1:0;
				if($offset){
					if($monthly){
						$curr_month = date('m',strtotime($date));
						$curr_year = date('Y',strtotime($date));
						$curr_month_days = cal_days_in_month(CAL_GREGORIAN,$curr_month,$curr_year);
						if($curr_month == 12){
							$next_month = 1;
							$next_year = $curr_year+1;
						}else{
							$next_month = $curr_month+1;
							$next_year = $curr_year;
						}
						$next_month_days = cal_days_in_month(CAL_GREGORIAN,$next_month,$next_year);
						$end_date = $next_year.'-'.$next_month.'-'.$next_month_days;
						$start_date = $curr_year.'-'.$curr_month.'-'.$curr_month_days;
					}else{
						$start_date = date('Y-m-d',strtotime($date));
						$end_date = date('Y-m-d',strtotime($date) + 7*86400);
					}
				}else{
					if($monthly){
						$curr_month = date('m',strtotime($date));
						$curr_year = date('Y',strtotime($date));
						
						if($curr_month == 1){
							$prev_month = 12;
							$prev_year = $curr_year-1;
						}else{
							$prev_month = $curr_month-1;
							$prev_year = $curr_year;
						}
						$prev_month_days = cal_days_in_month(CAL_GREGORIAN,$prev_month,$prev_year);
						$end_date = $prev_year.'-'.$prev_month.'-'.$prev_month_days;
						$start_date = date("Y-m-d",strtotime($prev_year.'-'.$prev_month.'-1')-86400);
					}else{
						$start_date = date('Y-m-d',strtotime($date) - 8*86400);
						$end_date = date('Y-m-d',strtotime($date) - 86400);
					}
				}
				echo $this->populate_data($start_date, $end_date, $monthly);
			}
		}
		
		public function action_export($date, $monthly=0){
			$this->auto_render = false;
			if($monthly){
				$curr_month = date('m',strtotime($date));
				$curr_year = date('Y',strtotime($date));
				$curr_month_days = cal_days_in_month(CAL_GREGORIAN, $curr_month, $curr_year);
				$start_date = date('Y-m-d',strtotime($date)-86400);
				$end_date = date('Y-m-d',strtotime($date) + ($curr_month_days-1)*86400);
			}else{
				$start_date = date('Y-m-d',strtotime($date)-86400);
				$end_date = date('Y-m-d',strtotime($date) + 6*86400);
			}
			$data = $this->populate_data($start_date, $end_date, $monthly, 1);
			$month = date('F',strtotime($date));
			$year = date('Y',strtotime($date));

			/*$xls = new Excel;
			$content_array[] = array("Vehicle ID", "Model", ($monthly ? $month.'-'.$year:'Weekly '.$date.' / '.$end_date));
			$date_array = array("","");
			foreach($data['dates'] as $key=>$value){
				$date_array[] = $value['date']." ".date('l', strtotime($value['date']));
			}
			$content_array[] = $date_array;
			
			
			foreach($data['models'] as $key=>$value){
				foreach($value['vehicles'] as $subkey=>$subvalue){
					$row_array = array($subvalue, $value['title']."-$".$value['price']);
					for($i=0; $i<count($data['dates']); $i++){					
						if(isset($data['orders'][$data['dates'][$i]['date']]) AND isset($data['orders'][$data['dates'][$i]['date']][$subvalue])){
							$row_array[] = $data['orders'][$data['dates'][$i]['date']][$subvalue]['name'];
						}else{
							$row_array[] = "";
						}
					}					
					$content_array[] = $row_array;
				}
			}
			$xls->addArray($content_array);
			*/
			$content = "Vehicle ID, Model, ".($monthly ? $month.'-'.$year:'Weekly '.$date.' / '.$end_date)." \n";
			$content .= ", "; 
			foreach($data['dates'] as $key=>$value){
				$content .= ", ".$value['date']." ".date('l', strtotime($value['date']));
			}
			
			$content .= " \n";
			
			foreach($data['models'] as $key=>$value){
				foreach($value['vehicles'] as $subkey=>$subvalue){
					$content .= $subvalue.", ".str_replace(",","",$value['title'])."-$".$value['price'];
					for($i=0; $i<count($data['dates']); $i++){					
						$content .= ", ";
						if(isset($data['orders'][$data['dates'][$i]['date']]) AND isset($data['orders'][$data['dates'][$i]['date']][$subvalue])){
							$content .= utf8_decode(str_replace(",","",$data['orders'][$data['dates'][$i]['date']][$subvalue]['name']));
						}
					}					
					$content .= " \n";					
				}
			}
			
			$filename = ($monthly ? $month.'-'.$year.'-':'').time().'.csv';
			header('Content-Type: application/csv'); 
			header('Content-Disposition: attachment; filename="'.$filename.'"'); 
			header("Pragma: no-cache");
			header("Expires: 0");
			echo $content;
			/*$filename = ($monthly ? $month.'-'.$year.'-':'').time();			
			$xls->generateXML ($filename);*/
			exit();  			
		}
	}

?>