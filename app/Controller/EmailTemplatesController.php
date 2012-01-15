<?php
App::uses('AppController', 'Controller');
/**
 * Plugin Controller
 *
 */
class EmailTemplatesController extends AppController
{
	public $uses = array('Plugin', 'Permission', 'Role', 'PluginView');
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'GeneralConfiguration', true);
    }

    function index()
    {
    	$this->layout = 'overlay';

    }
}
