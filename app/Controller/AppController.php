<?php

class AppController extends Controller
{

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/'
        ),
        'Permission'
    );

    public $helpers = array('Html', 'Form', 'Session', 'Js', 'Permission');

    function beforeFilter()
    {
    }
}
