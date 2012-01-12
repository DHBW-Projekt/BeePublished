<?php
App::uses('AppHelper', 'View/Helper');

class FckHelper extends AppHelper {
    var $helpers = array('Html', 'Js');

    public function load($id) {
        $did = '';
        foreach (explode('.', $id) as $v) {
            $did .= ucfirst($v);
        } 

        $code = "CKEDITOR.replace( '".$did."' );";
        return $this->Html->scriptBlock($code,array('inline' => true));
    }
}