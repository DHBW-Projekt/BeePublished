<?php
App::uses('AppController', 'Controller');
/**
 * MenuEntries Controller
 *
 * @property MenuEntry $MenuEntry
 */
class MenuEntriesController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

    function add()
    {
        if ($this->request->is('post')) {
            $this->MenuEntry->create();
            if ($this->MenuEntry->save($this->request->data)) {
                $this->Session->setFlash(__('The menu entry has been saved'));
            } else {
                $this->Session->setFlash(__('The menu entry could not be saved. Please, try again.'));
            }
        }
        $roles = $this->MenuEntry->Role->find('list');
        $pages = $this->MenuEntry->Page->find('list');
        $parents = $this->MenuEntry->ParentMenuEntry->find('list');
        $this->set(compact('roles'));
        $this->set(compact('pages'));
        $this->set(compact('parents'));
    }

}
