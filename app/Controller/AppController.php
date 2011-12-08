<?php

class AppController extends Controller {

	public $components = array(
		'Acl',
		'Auth' => array(
			'authorize' => array(
				'Actions' => array('actionPath' => 'controllers')
			)
		),
		'Session'
		);

	public $helpers = array('Html', 'Form', 'Session');

	function beforeFilter() {
		//Configure AuthComponent
		//which function in which class gets called on LOGIN?
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		//redirect for successfull logout
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		//redirect for successfull login
		$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'register');
	}
}
