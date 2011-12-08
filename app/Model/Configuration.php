<?php

class Configuration extends AppModel
{

    public $name = 'Configuration';

    public $validate = array(
        'firstname' => array(
            'rule' => '/^[a-zA-z]*$/',
            'allowEmpty' => false,
            'required' => false,
            'message' => 'Please enter your first name.',

        ), //firstname
        'lastname' => array(
            'rule' => '/^[a-zA-z]*$/',
            'allowEmpty' => false,
            'required' => false,
            'message' => 'Please enter your last name.',

        ), //lastname
        'email' => array(
            'rule' => 'email',
            'allowEmpty' => false,
            'required' => false,
            'message' => 'Please enter a valid e-mail address.',
        ), //email
    ); //validate

    public $actsAs = array(
        'KeyValue' => array(
            'uniqueKeys' => true,
            'fields' => array(
                'key' => 'key',
                'value' => 'value'
            )
        )
    );

} //class
?>