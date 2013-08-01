<?php

	class Controller_Admin_Template extends Controller_Template
	{
		public $template    = 'admin/layout';
		public $auto_render = true;
		
		function get_flashdata($name){
			$session = Session::instance();
			return $session->get_once($name); 
		}
	
		function set_flashdata($name, $value){
			$session = Session::instance();
			$session->set($name, $value);
		}
		
		function before(){
			parent::before();
			$this->template->message = $this->get_flashdata('message');
			$session = Session::instance();
		}
		
		function file_fetcher($type){
			switch($type){
				case 'datepicker':
					return array('js'=>array('jquery.ui.datepicker.min.js','jquery.ui.widget.min.js','jquery.ui.core.min.js'));
				case 'reservations':
					return array('js'=>array('admin/reservations.js'));
				case 'list':
					return array('js'=>array('jquery.dataTables.min.js','admin/lists.js'));
				case 'tabs':
					return array('js'=>array('jquery.ui.widget.min.js','jquery.ui.core.min.js','jquery.ui.tabs.min.js'));
				case 'availability':
					return array('js'=>array('admin/availability.js'));
				case 'prettyphoto':
					return array('js'=>array('jquery.prettyphoto.js'),'css'=>array('prettyphoto.css'));
				case 'tooltip':
					return array('js'=>array('vtip.js'));
			}
		}
	}
?>