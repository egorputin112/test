<?php

	class Controller_Admin_Requests extends Controller_Admin_Template
	{
	
		public function action_index()
		{
			$requests = ORM::factory('Contact_Request')->order_by('datetime', 'desc')->find_all();
			$this->template->content = View::factory('admin/requests/list', compact('requests'));
		}
		
		public function action_delete($request_id){
			if(count($_POST) > 0){
				if(isset($_POST['confirm'])){
					ORM::factory('Contact_Request', $request_id)->delete();
					$this->set_flashdata('message','Request deleted successfully.');
				}
				$this->request->redirect('admin/requests');
			}
			$request = ORM::factory('Contact_Request')->where('id','=',$request_id)->find();
			$confirmation = 'Do you surely want to delete this contact request from '.$request->name.' arrived at '.$request->datetime.' ?';
			$form_uri = 'admin/requests/delete/'.$request_id;
			$this->template->content = View::factory('admin/delete', compact('confirmation','form_uri'));
		}
	}

?>