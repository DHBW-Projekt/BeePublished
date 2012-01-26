<?php
App::uses('AppModel', 'Model');
/**
 * File Model
 *
 */
class MyFileConfig extends FileShareAppModel
{

    public $useTable = 'my_files_config';
    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'key';
    public $displayField = 'value';

}

?>