<?php
App::uses('AppModel', 'Model');
/**
 * Page Model
 *
 * @property Container $Container
 * @property User $User
 * @property MenuEntry $MenuEntry
 */
class Page extends AppModel
{
    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Container' => array(
            'className' => 'Container',
            'foreignKey' => 'container_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'MenuEntry' => array(
            'className' => 'MenuEntry',
            'foreignKey' => 'page_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );

}
