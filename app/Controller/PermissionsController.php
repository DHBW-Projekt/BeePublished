<?php
App::uses('AppController', 'Controller');
/**
 * Permissions Controller
 *
 * @property Permission $Permission
 */
class PermissionsController extends AppController
{

    public $uses = array('Permission', 'Role');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'GeneralConfiguration', true);
    }

    public function index()
    {
        $this->layout = 'overlay';
        if (!empty($this->request->data)) {
            $this->Permission->saveAll($this->request->data['Permission']);
            $this->Session->setFlash('Successfully saved');
        }
        else {
            $this->request->data['Permission'] = Set::combine($this->Permission->find('all'), '{n}.Permission.id', '{n}.Permission');
        }
        $roles = $this->Role->find('list');
        $this->set('roles', $roles);
    }

}
