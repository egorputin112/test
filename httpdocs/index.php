<?php
	define('EXT', '.php');
	error_reporting(E_ALL | E_STRICT);

	define('DOCROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

	define('APPPATH', DOCROOT . 'application' . DIRECTORY_SEPARATOR);
	define('MODPATH', DOCROOT . 'modules' . DIRECTORY_SEPARATOR);
	define('SYSPATH', DOCROOT . 'system' . DIRECTORY_SEPARATOR);

	require_once SYSPATH . 'base' . EXT;
	require_once SYSPATH . 'classes/kohana/core' . EXT;

//	if (is_file(APPPATH . 'classes/kohana' . EXT)) {
//		require_once APPPATH . 'classes/kohana' . EXT;
//	}
//	else {
		require_once SYSPATH . 'classes/kohana' . EXT;
//	}

	require_once APPPATH . 'bootstrap' . EXT;
?>