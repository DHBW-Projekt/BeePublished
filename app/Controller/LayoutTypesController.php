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
        $role = $this->PermissionValidation->getUserRoleId();
        if ($role != 6 && $role != 7) {
            $this->redirect($this->request->webroot);
        }
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
