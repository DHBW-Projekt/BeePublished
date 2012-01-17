<?php
App::uses('AppController', 'Controller');
/**
 * LayoutTypes Controller
 *
 * @property LayoutType $LayoutType
 */
class LayoutTypesController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'LayoutManager',true);
    }

    function json()
    {
        $data = $this->LayoutType->find('all');
        $layouts = array();
        foreach ($data as $layout) {
            $layouts[] = $layout['LayoutType'];
        } // for
        $this->layout = 'ajax';
        $this->response->type('json');
        $jsonString = json_encode($layouts);
        $this->set('layouts', $jsonString);
    }
}
