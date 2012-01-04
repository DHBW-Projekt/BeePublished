<?php

class AppController extends Controller
{

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/'
        ),
        'PermissionValidation'
    );

    public $helpers = array('Html', 'Form', 'Session', 'Js', 'PermissionValidation');

    function beforeFilter()
    {
    }
}
