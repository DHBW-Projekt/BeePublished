<?php

class AppController extends Controller
{

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/',
            'loginAction' => array('controller' => 'Users', 'action' => 'login')
        ),
        'PermissionValidation',
        'Config'
    );

    public $helpers = array('Html', 'Form', 'Session', 'Js', 'PermissionValidation');

    public $viewClass = 'Theme';

    function beforeFilter()
    {
        $this->theme = $this->Config->getValue('active_template');
        $this->set('mobile',$this->RequestHandler->isMobile());
        $this->set('design', $this->Config->getValue('active_design'));
        $this->Session->write('Config.language', Configure::read('Config.language'));
    }

    function afterFilter()
    {
        $this->_deleteValidation();
    }

    function _persistValidation()
    {
        $args = func_get_args();
        foreach ($args as $modelName) {
            if (!empty($this->{$modelName}->validationErrors) || !empty($this->{$modelName}->data)) {
                $this->Session->write('Validation.' . $modelName, array(
                    'controller' => $this->name,
                    'data' => $this->{$modelName}->data,
                    'validationErrors' => $this->{$modelName}->validationErrors
                ));
            }
        }
    }

    function _deleteValidation()
    {
        $this->Session->delete('Validation');
    }
}
