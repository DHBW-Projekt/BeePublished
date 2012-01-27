<?php
App::uses('AppController', 'Controller');
/**
 * MenuEntries Controller
 *
 * @property MenuEntry $MenuEntry
 */
class MenuEntriesController extends AppController
{

    var $components = array('RequestHandler', 'Menu', 'Config');
    var $uses = array('MenuEntry', 'Page', 'Container');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'LayoutManager',true);
    }

    function add($parent)
    {
        $this->layout = 'overlay';
        if ($this->request->is('post')) {
            $error = false;
            $this->MenuEntry->create();
            $data = $this->request->data;
            
            $url = $this->_getPageURL($parent, $data['MenuEntry']['name']);
            
            $this->Page->create();
            $this->Page->set('title', $data['MenuEntry']['name']);
            $this->Page->set('name', $url);
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
            
            if (!$error) {
                if ($parent == 0) $parent = null;
                $data['MenuEntry']['parent_id'] = $parent;
                
                $parentEntry = $this->MenuEntry->find('first', array(
        			'order' => array('MenuEntry.order' => 'desc'),
        			'conditions' => array('MenuEntry.parent_id' => $parent),
                	'fields' => 'MenuEntry.order',
                ));
                $data['MenuEntry']['order'] = $parentEntry['MenuEntry']['order'] + 1;
                
                if (!$this->MenuEntry->save($data)) {
                    $error = true;
                    $this->Page->delete();
                }
            }
            
            if (!$error) {
                $this->render('close');
                return;
            }
        }
        $roles = $this->MenuEntry->Role->find('list');
        $this->set(compact('roles'));
    }

    function edit($id)
    {
        $this->layout = 'overlay';
        $this->MenuEntry->id = $id;
        if (!$this->MenuEntry->exists()) {
            throw new NotFoundException(__('Invalid Menu Entry'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->MenuEntry->save($this->request->data)) {
            	$menuEntry = $this->MenuEntry->findById($id);
            	$page = $this->Page->findById($menuEntry['MenuEntry']['page_id']);
            	
            	$this->Page->id = $menuEntry['MenuEntry']['page_id'];
            	$page['Page']['title'] = $menuEntry['MenuEntry']['name'];
            	$page['Page']['name'] = $this->_getPageURL($menuEntry['MenuEntry']['parent_id'], $menuEntry['MenuEntry']['name']);
            	$this->Page->save($page);
            	
                $this->render('close');
                return;
            }
        } else {
            $this->request->data = $this->MenuEntry->read(null, $id);
        }
        $roles = $this->MenuEntry->Role->find('list');
        $this->set(compact('roles'));
    }

    public function delete($id = null)
    {
    	$this->PermissionValidation->actionAllowed(null, 'LayoutManager',true);
    	
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->MenuEntry->id = $id;
        if (!$this->MenuEntry->exists()) {
            throw new NotFoundException(__('Invalid menu entry'));
        }
        
        $menuEntry = $this->MenuEntry->findById($this->MenuEntry->id);
        
        if (isset($menuEntry['ChildMenuEntry']))
	        foreach ($menuEntry['ChildMenuEntry'] as $child):
	        	$this->delete($child['id']);
	        endforeach;
        
	    $this->MenuEntry->delete($menuEntry['MenuEntry']);
	    $this->Page->delete($menuEntry['Page']);

       $this->render('close');
    }

    function sort()
    { 
        $this->layout = 'overlay';
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
                
                $page = $this->Page->findById($entry['MenuEntry']['page_id']);
                $page['Page']['name'] = $this->_getPageURL($parent, $entry['MenuEntry']['name']);
                $this->Page->save($page);
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
            $menu[$idx]['name'] = $entry['name'];
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
    
    function _getPageURL($parentEntryID, $name) {
    	$name = Inflector::slug($name, "-");
    	$name = strtolower($name);
    	
    	if ($parentEntryID <> 0) {
    		$parentEntry = $this->MenuEntry->findById($parentEntryID);
    		$parentPage = $this->Page->findById($parentEntry['MenuEntry']['page_id']);

    		return $parentPage['Page']['name']."/".$name;
    	} else {
    		if ($name == "home" or $name == "startseite" or $name == $this->Config->getValue('page_name')) {
    			return "/";
    		} else {
    			return "/".$name;
    		}
    	}
    }
}
