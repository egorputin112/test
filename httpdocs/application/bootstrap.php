<?php defined('SYSPATH') or die('No direct script access.');

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en_US.utf-8');
spl_autoload_register(array('Kohana', 'auto_load'));
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
	'index_file' => false,
	'caching'    => true,
));

Kohana::modules(
	array(
		'sqlmon'   => MODPATH . 'sqlmon',
		'orm'      => MODPATH . 'orm',
		'database' => MODPATH . 'database',
	)
);

Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));
Kohana::$config->attach(new Kohana_Config_File);

Route::set('admin', 'admin(/<controller>(/<action>(/<id>(/<para>))))')
	->defaults(array(
		'directory'  => 'admin',
		'controller' => 'reservations',
		'action'     => 'index',
	));

Route::set('order', 'order(/<action>)')
	->defaults(array(
		'controller' => 'order',
		'action'     => 'step1',
	));
Route::set('contact', '<controller>(/<action>)',array('controller'=>'contact'))
	->defaults(array(
		'controller' => 'contact',
		'action'     => 'index',
	));
Route::set('static', '(<page>)', array('page' => '[a-z0-9-]+'))
	->defaults(array(
		'controller' => 'static',
		'action'     => 'index',
		'page'       => 'index',
	));

echo Request::instance()
	->execute()
	->check_cache()
	->send_headers()
	->response;

?>