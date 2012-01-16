<?php

function CheckAuthentication()
{

	define('APP_DIR', '../../../');
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', dirname(__FILE__));
	define('WEBROOT_DIR', 'webroot');
	define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);
	require_once('../../../lib/Cake/bootstrap.php');

	App::uses('CakeSession', 'Model/Datasource');
	CakeSession::start();

	$auth = CakeSession::read('Auth');
	$_SESSION['KCFINDER'] = array();
	if (!empty($auth)) {
		$_SESSION['KCFINDER']['disabled'] = false;
		return true;
	} else {
		$_SESSION['KCFINDER']['disabled'] = true;
		return false;
	}

}

CheckAuthentication();

spl_autoload_register('__autoload');

?>