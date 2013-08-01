<?php

	class Controller_Static extends Controller_Template
	{
		protected $page;
		protected $cacheable = true;

		public function before()
		{
			$matches = array(
				'rental-faqs'                 => 'faqs',
				'boat-services-trailer-sales' => 'services',
				'page-az-location'            => 'location',
				'rates-models'                => 'models',
				'terms-of-use'                => 'tou',
				'privacy-policy'              => 'privacy',
				'our-company'                 => 'company',
				'site-map'                    => 'sitemap',
				'contact-us'                  => 'contact',
				'boat-rentals'                => 'boat-rentals',
			);

			$this->page = $this->request->param('page');
			if (!isset($matches[$this->page])) {
				$this->page     = 'index';
				$this->template = 'index';
			}
			else {
				$this->template = $matches[$this->page];
			}

			parent::before();

			$this->template->extra_css = '';
			$this->template->extra_js  = '';
		}

		public function after()
		{
			parent::after();
			@file_put_contents(APPPATH . 'web/cache/' . $this->request->param('page') . '.html', $this->request->response);
		}

		public function action_index()
		{
			switch ($this->page) {
				case 'index':
					$this->template->extra_css = HTML::style('css/datepicker.css');
					$this->template->extra_js  = HTML::script('scripts/datepicker.js') .
					                             HTML::script('scripts/calendar.js');
					break;

				case 'page-az-location':
					$this->template->extra_js = HTML::script('http://www.google.com/jsapi?key=ABQIAAAAyzJW2Yd3Zc1WFMvAlRUUDxSdSqNxQGN5uVbP3tkbxH2oyMVfkhR0Tb4voxTXF7k0Px02uFNqLM0niQ') .
					                            HTML::script('scripts/googlemap.js');
					break;

				case 'rates-models':
					$this->cacheable           = false;
					$this->template->extra_css = HTML::style('css/jquery.css') .
					                             HTML::style('css/datepicker.css');
					$this->template->extra_js  = HTML::script('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js') .
					                             HTML::script('scripts/datepicker.js') .
					                             HTML::script('scripts/calendar.js');
					$this->template->models    = ORM::factory('Model')->find_all();
					break;
				case 'contact-us':
					require_once Kohana::find_file('classes','recaptchalib','php');
					$this->template->extra_css = HTML::style('css/contact-form/standard.css').
												 HTML::style('css/contact-form/pagestyles.css');
					$this->template->extra_js =  HTML::script('scripts/jquery-1.4.4.min.js').
												 HTML::script('scripts/contact-form/contact-form.js').
												 HTML::script('scripts/contact-form/plugins.js').
					                             HTML::script('scripts/contact-form/scripts.js');
					$this->template->recaptcha = recaptcha_get_html('6LeRScYSAAAAAMMuRfVNgadZ0M08qNZHLXKyPlEK');
			}
		}
		
		
	}

?>