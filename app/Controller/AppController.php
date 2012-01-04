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
    
    /**
     * Called with some arguments (name of default model, or model from var $uses),
     * models with invalid data will populate data and validation errors into the session.
     *
     * Called without arguments, it will try to load data and validation errors from session 
     * and attach them to proper models. Also merges $data to $this->data in controller.
     * 
     * @author poLK
     * @author drayen aka Alex McFadyen
     * 
     * Licensed under The MIT License
     * @license            http://www.opensource.org/licenses/mit-license.php The MIT License
     */
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

    function beforeFilter()
    {
    }
}
