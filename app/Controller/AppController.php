<?php

class AppController extends Controller
{

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/'
        )
    );

    public $helpers = array('Html', 'Form', 'Session');

    function beforeFilter()
    {
    }
}
