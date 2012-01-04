<?php

class AppController extends Controller
{

    function afterFilter(){
    	$this->_deleteValidation();
    }
    
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/'
        ),
        'PermissionValidation'
    );
    
    function _persistValidation() {
        $args = func_get_args();      	
        foreach($args as $modelName) {
			if (!empty($this->{$modelName}->validationErrors)) {
				$this->Session->write('Validation.'.$modelName, array(
                                                        'controller'           => $this->name,
                                                        'data'                 => $this->{$modelName}->data,
                                                        'validationErrors'     => $this->{$modelName}->validationErrors
                ));
            }
        }
    }
    
    function _deleteValidation() {
    	$this->Session->delete('Validation');    	
    }

    public $helpers = array('Html', 'Form', 'Session', 'Js', 'PermissionValidation');
}
