<?php

	class Controller_Admin_Accessories extends Controller_Admin_Template
	{
		public function action_index()
		{
			$accessories = ORM::factory('Accessory')->order_by('id','asc')->find_all();
			$this->template->content = View::factory('admin/accessories/list', compact('accessories'));
		}

		public function action_delete($id)
		{
			$accessory = ORM::factory('Accessory')->where('id','=',$id)->find();
			if(count($_POST) > 0){
				if(isset($_POST['confirm'])){
					ORM::factory('Accessory', $id)->delete();
					$this->set_flashdata('message', 'Accessory deleted successfully.');
				}
				$this->request->redirect('admin/accessories');
			}
			
			$confirmation = 'Do you surely want to delete the accessory <b>'.$accessory->name.'</b> ?';
			$form_uri = 'admin/accessories/delete/'.$id;
			$this->template->content = View::factory('admin/delete', compact('confirmation','form_uri'));
		}

		public function action_edit($id)
		{
			if(count($_POST) > 0){
				
				$post = Validate::factory($_POST)->filter(TRUE,'trim')
				                          ->rule('name','not_empty')
										  ->rule('price','not_empty');
				if($post->check()){
					$accessory = ORM::factory('Accessory')->where('id', '=', $id)->find();
					$accessory->values($_POST);
					$accessory->save();
									
					$this->set_flashdata('message', 'Accessory updated successfully.');
					$this->request->redirect('admin/accessories');
				}else
					$this->template->errors = $post->errors('admin/accessories');
			}
			$accessory = ORM::factory('Accessory')->where('id','=',$id)->find();
			$this->template->content = View::factory('admin/accessories/edit', compact('accessory'));
		}
		
		public function action_add()
		{
			if(count($_POST) > 0){
				$post = Validate::factory($_POST)->filter(TRUE,'trim')
				                          ->rule('name','not_empty')
										  ->rule('price','not_empty');
				if($post->check()){
					$accessory = ORM::factory('Accessory');
					$accessory->values($_POST);
					$accessory_id = $accessory->save();
					$this->set_flashdata('message', 'Accessory added successfully.');
					$this->request->redirect('admin/accessories');
				}else
					$this->template->errors = $post->errors('admin/accessories');
			}
			$view = View::factory('admin/accessories/add');
			$this->template->content = $view;
		}
	}

?>