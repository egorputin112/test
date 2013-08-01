<?php

	class Controller_Admin_Models extends Controller_Admin_Template
	{
		var $prefix = 'images/products/';
		public function action_index()
		{
			$models = ORM::factory('Model')->order_by('id','asc')->find_all();
			$this->template->content = View::factory('admin/models/list', compact('models'));
		}

		public function action_delete($id)
		{
			$model = ORM::factory('Model')->where('id','=',$id)->find();
			if(count($_POST) > 0){
				if(isset($_POST['confirm'])){
					ORM::factory('Model', $id)->delete();
					ORM::factory('Vehicle')->where('model_id', '=', $id)->delete_all();
					if(file_exists($this->prefix.$model->image))
						unlink($this->prefix.$model->image);
					$this->set_flashdata('message', 'Model deleted successfully.');
				}
				$this->request->redirect('admin/models');
			}
			
			$confirmation = 'Do you surely want to delete the model Title:'.$model->title.' ?';
			$form_uri = 'admin/models/delete/'.$id;
			$this->template->content = View::factory('admin/delete', compact('confirmation','form_uri'));
		}

		public function action_edit($id)
		{
			if(count($_POST) > 0){
				
				$post = Validate::factory($_POST)->filter(TRUE,'trim')
				                          ->rule('title','not_empty')
										  ->rule('price','not_empty')
										  ->rule('strokes','not_empty')
										  ->rule('seats','not_empty')
										  ->rule('fuel','not_empty')
										  ->rule('engine','not_empty')
										  ->rule('horsepower','not_empty');
				if($post->check()){
					
					if(!empty($_FILES['image']['name'])){	
						$filename = $this->unique_filename($_FILES['image']['name']);
						$_POST['image'] = $filename;
						move_uploaded_file($_FILES['image']['tmp_name'], $this->prefix.$filename); 
					}
					
					$model = ORM::factory('Model')->where('id', '=', $id)->find();
					$saved_vehicles = $model->vehicles->find_all();
					$model->values($_POST);
					$model->save();
			
					$vehicles = trim($_POST['vehicles']);
					if(is_numeric($vehicles)){
						if($vehicles <> count($saved_vehicles)){
							if($vehicles > count($saved_vehicles)){
								$new_vehicles = $vehicles - count($saved_vehicles);
								for($i=1; $i<=$new_vehicles; $i++){
									ORM::factory('Vehicle')->values(array('model_id'=>$id))->save();
								}	
							}else{
								$delete_vehicles = count($saved_vehicles) - $vehicles;
								ORM::factory('Vehicle')->where('model_id','=',$id)->order_by('id','desc')->limit($delete_vehicles)->delete_all();;
							}
						}
					}						
					$this->set_flashdata('message', 'Model updated successfully.');
					$this->request->redirect('admin/models');
				}else
					$this->template->errors = $post->errors('admin/models');
			}
			$model = ORM::factory('Model')->where('id','=',$id)->find();
			$this->template->content = View::factory('admin/models/edit', compact('model'));
		}
		
		public function action_add()
		{
			if(count($_POST) > 0){
				
				$post = Validate::factory($_POST)->filter(TRUE,'trim')
				                          ->rule('title','not_empty')
										  ->rule('price','not_empty')
										  ->rule('strokes','not_empty')
										  ->rule('seats','not_empty')
										  ->rule('fuel','not_empty')
										  ->rule('engine','not_empty')
										  ->rule('horsepower','not_empty');
				if($post->check()){
					if(empty($_FILES['image']['name']))
						$this->template->errors = array('Model image is required.');
					else{
						$model = ORM::factory('Model');
						
						$filename = $this->unique_filename($_FILES['image']['name']);
						$_POST['image'] = $filename;
						move_uploaded_file($_FILES['image']['tmp_name'], $this->prefix.$filename); 
						$model->values($_POST);
						$model_id = $model->save();
						$vehicles = trim($_POST['vehicles']);
						if(is_numeric($vehicles)){
							for($i=1; $i<=$vehicles; $i++){
								ORM::factory('Vehicle')->values(array('model_id'=>$model_id))->save();
							}
						}						
						$this->set_flashdata('message', 'Model added successfully.');
						$this->request->redirect('admin/models');
					}
				}else
					$this->template->errors = $post->errors('admin/models');
			}
			$view = View::factory('admin/models/add');
			$this->template->content = $view;
		}

		private function unique_filename($filename){
			$i=1;
			while(file_exists($this->prefix.$filename)){
				$parts = explode(".",$filename);
				$filename = substr($filename,0,strrpos($filename,".")).'-'.$i.'.'.end($parts);
				$i++;
			}
			return $filename;
		}
	}

?>