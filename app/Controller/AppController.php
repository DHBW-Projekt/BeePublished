<?php

class AppController extends Controller
{

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', '/'),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', '/')
        )
    );

    public $helpers = array('Html', 'Form', 'Session');

    function beforeFilter()
    {
    }
}
