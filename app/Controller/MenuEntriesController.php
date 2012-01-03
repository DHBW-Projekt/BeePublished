<?php
App::uses('AppController', 'Controller');
/**
 * MenuEntries Controller
 *
 * @property MenuEntry $MenuEntry
 */
class MenuEntriesController extends AppController
{

    var $components = array('RequestHandler', 'Menu');
    var $uses = array('MenuEntry', 'Page', 'Container');

    function beforeFilter()
    {
        parent::beforeFilter();

    }

    function add($parent)
    {
        $this->autoLayout = false;
        if ($this->request->is('post')) {
            $error = false;
            $this->MenuEntry->create();
            $data = $this->request->data;
            if ($data['MenuEntry']['new_page'] == 1) {
                $this->Page->create();
                $this->Page->set('title', $data['MenuEntry']['name']);
                $this->Page->set('name', $data['MenuEntry']['url']);
                $this->Page->set('user_id', $this->Auth->user('id'));
                $this->Page->set('container_id', $this->Container->id);
                if ($this->Page->save()) {
                    $data['MenuEntry']['page_id'] = $this->Page->id;
                    $this->Container->create();
                    $this->Container->set('column', 0);
                    $this->Container->set('order', 0);
                    $this->Container->set('page_id', $this->Page->id);
                    $this->Container->save();
                } else {
                    $error = true;
                    $this->MenuEntry->validationErrors = $this->Page->validationErrors;
                }
            }
            if (!$error) {
                if ($parent == 0) $parent = null;
                $data['MenuEntry']['parent_id'] = $parent;
                if (!$this->MenuEntry->save($data)) {
                    $error = true;
                    if ($data['MenuEntry']['new_page'] == 1) {
                        $this->Page->delete();
                    }
                }
            }
            if (!$error) {
                $this->render('close');
                return;
            }
        }
        $roles = $this->MenuEntry->Role->find('list');
        $pages = $this->MenuEntry->Page->find('list');
        $this->set(compact('roles'));
        $this->set(compact('pages'));
    }

    function edit($id)
    {
        $this->autoLayout = false;
        $this->MenuEntry->id = $id;
        if (!$this->MenuEntry->exists()) {
            throw new NotFoundException(__('Invalid Menu Entry'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            var_dump('test');
            if ($this->MenuEntry->save($this->request->data)) {
                $this->render('close');
                return;
            }
        } else {
            $this->request->data = $this->MenuEntry->read(null, $id);
        }
        $roles = $this->MenuEntry->Role->find('list');
        $pages = $this->MenuEntry->Page->find('list');
        $this->set(compact('roles'));
        $this->set(compact('pages'));
    }

    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->MenuEntry->id = $id;
        if (!$this->MenuEntry->exists()) {
            throw new NotFoundException(__('Invalid menu entry'));
        }
        $this->MenuEntry->delete();
        $this->render('close');
    }

    function sort()
    {
        $this->autoLayout = false;
        if ($this->request->is('post')) {
            $data = $this->request->data;
            $order = array();
            foreach ($data['menu_entry'] as $idx => $parent) {
                if ($parent == 'root') {
                    $parent = 0;
                }
                if (!array_key_exists($parent, $order)) {
                    $order[$parent] = 0;
                }
                $order[$parent]++;
                $position = $order[$parent];
                if ($parent == 0) {
                    $parent = null;
                }
                $entry = $this->MenuEntry->findById($idx);
                $entry['MenuEntry']['parent_id'] = $parent;
                $entry['MenuEntry']['order'] = $position;
                $this->MenuEntry->save($entry);
            }
        }
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
    }

    function json()
    {
        $data = $this->Menu->buildMenu($this, NULL);
        $menu = $this->createMenuArray($data);
        $this->layout = 'ajax';
        $this->response->type('json');
        $jsonString = json_encode($menu);
        $this->set('menu', $jsonString);
    }

    function createMenuArray($data)
    {
        $menu = array();
        foreach ($data as $idx => $entry) {
            $menu[$idx]['id'] = $entry['id'];
            $menu[$idx]['name'] = htmlentities($entry['name']);
            if ($entry['page_id'] != null) {
                $link = $entry['Page']['name'];
            } else {
                $link = null;
            }
            $menu[$idx]['link'] = $this->request->webroot . 'admin' . $link;
            $menu[$idx]['page'] = $entry['page_id'];
            if (!empty($entry['Children'])) {
                $menu[$idx]['submenu'] = $this->createMenuArray($entry['Children']);
            }
        }
        return $menu;
    }

}
