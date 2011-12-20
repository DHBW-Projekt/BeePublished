<?php

class Configuration extends AppModel
{

    //TODO
    // '/' in Phone and Fax
    // 4/5 fields are missing
    // check validation


    public $name = 'Configuration';

    public $validate = array(
        'firstName' => array(
            'rule' => '/^[a-zA-z]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter your first name.',

        ), //firstname
        'lastName' => array(
            'rule' => '/^[a-zA-z]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter your last name.',

        ), //lastname
        'eMail' => array(
            'rule' => 'email',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid e-mail address.',
        ), //email
        'street' => array(
            'rule' => '/^[a-zA-z0-9-.]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid address.',
        ), //street
        'houseNumber' => array(
            'rule' => '/^[0-9a-z-]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid address.',
        ), //houseNumber
        'postCode' => array(
            'rule' => '/^[A-z0-9-]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid address.',
        ), //postCode
        'city' => array(
            'rule' => '/^[a-zA-z]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid address.',
        ), //city
        'phone' => array(
            'rule' => '/^[0-9-]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid phone number.',
        ), //phone
        'fax' => array(
            'rule' => '/^[0-9-]*$/',
            'allowEmpty' => false,
            'required' => true,
            'message' => 'Please enter a valid fax number.',
        ), //fax
// 		'companyName' => array(
// 			'rule' => '',
// 		),
// 		'legalForm' => array(
// 			'rule' => '',
// 		),
// 		'vatid' => array(
// 			'rule' => '',
// 		),
// 		'registerNumber' => array(
// 			'rule' => '',
// 		),
// 		'status' => array(
// 			'rule' => '',
// 		),
        'activeDesign' => array(
            'rule' => 'notEmpty',
// 			'allowEmpty' => false,
// 			'required' => true,
            'message' => 'Please chose a design.',
        ), //activeDesign
        'activeTemplate' => array(
            'rule' => 'notEmpty',
// 			'allowEmpty' => false,
// 			'required' => true,
            'message' => 'Please chose a template.',
        ), //activeTemplate
    ); //validate


} //class
?>