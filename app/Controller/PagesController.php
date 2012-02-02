<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Christoph Krämer
 *
 * @description Controller to build pages to display for user
 */

App::uses('AppController', 'Controller');

class PagesController extends AppController
{

    public $components = array('Menu');
    public $uses = array('Page', 'PluginView', 'Container', 'LayoutType', 'Content', 'ContentValue', 'MenuEntry');

    private $myUrl = null;

    function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('display');
    }

    function display()
    {
        $path = explode('/', $this->request->url);
        $this->set('adminMode', false);
        if (sizeof($path) > 0 && $path[0] == 'admin') {
            array_shift($path);
            //Check Admin rights
            if ($this->PermissionValidation->actionAllowed(null, 'AdminMode')) {
                $this->set('adminMode', true);
            } else {
                $url = $this->request->webroot . implode('/', $path);
                $this->redirect($url);
            }
        }
        $url = implode('/', $path);

        //Get page to display
        $page = $this->findPage($url);

        if (!$page) {
            $this->set('elements', array());
            $this->myUrl = null;
        } else {
            $pageUrl = $page['Page']['name'];
            $this->myUrl = $pageUrl;
            $url = '/' . $url;
            $count = 1;
            $diff = substr($url, strlen($pageUrl));

            if (substr($diff, 0, 1) == '/') {
                $diff = substr($diff, 1);
            }

            //Find elements for page to display
            $elements = $this->setupPageElements($page['Container'], $diff, true);
            ksort($elements);

            //Output data
            $this->set('elements', $elements);
        }

        $this->set('menu', $this->Menu->buildMenu($this, NULL));
        $this->set('pageid', $page['Page']['id']);
        $this->set('systemPage', false);
    }

    private function setupPageElements($container, $diff, $root = false)
    {
        $container = $this->Container->findById($container['id']);
        $children = array();

        if ($container['LayoutType']['id'] != null) {
            $widths = explode(':', $container['LayoutType']['weight']);
            foreach ($widths as $idx => $width) {
                if ($idx == 0) {
                    $class = 'c' . $width . 'l';
                    $contentClass = 'subcl';
                } elseif ($idx == sizeof($widths) - 1) {
                    $class = 'c' . $width . 'r';
                    $contentClass = 'subcr';
                } else {
                    $class = 'c' . $width . 'l';
                    $contentClass = 'subc';
                }
                $children['columns'][$idx]['class'] = $class;
                $children['columns'][$idx]['contentClass'] = $contentClass;
                $children['columns'][$idx]['children'] = array();
            }
        }

        if (array_key_exists('ChildContainer', $container)) {
            foreach ($container['ChildContainer'] as $childContainer) {
                if ($container['LayoutType']['id'] == null) {
                    $children[$childContainer['order']] = $this->setupPageElements($childContainer, $diff);
                } else {
                    if ($root && $container['LayoutType']['id'] != null) {
                        $children[$childContainer['column'] - 1]['children'][$childContainer['order']] = $this->setupPageElements($childContainer, $diff);
                    } else {
                        $children['columns'][$childContainer['column'] - 1]['children'][$childContainer['order']] = $this->setupPageElements($childContainer, $diff);
                    }
                }
            }
        }

        if (array_key_exists('Content', $container) && sizeof($container['Content'] > 0)) {
            foreach ($container['Content'] as $childContent) {
                $contentValues = $this->ContentValue->findAllByContentId($childContent['id']);
                $params = array();
                foreach ($contentValues as $contentValue) {
                    $params[$contentValue['ContentValue']['key']] = $contentValue['ContentValue']['value'];
                }

                $contentData = array();
                if ($childContent['plugin_view_id'] != null) {
                    $plugin = $this->PluginView->findById($childContent['plugin_view_id']);
                    $contentData['plugin'] = $plugin['Plugin']['name'];
                    $contentData['pluginId'] = $plugin['Plugin']['id'];
                    $contentData['view'] = $plugin['PluginView']['name'];
                    $urlParts = explode('/', $diff);
                    if ($urlParts[0] == strtolower($plugin['PluginView']['name'])) {
                        array_shift($urlParts);
                        $url = $urlParts;
                    } else {
                        $url = null;
                    }
                    $contentData['viewData'] = $this->Components->load($contentData['plugin'] . '.' . $contentData['view'])->getData($this, $params, $url, $childContent['id'],$this->myUrl);
                    $contentData['id'] = $childContent['id'];
                    $contentData['pageUrl'] = $this->myUrl;
                }
                if ($container['LayoutType']['id'] == null) {
                    $children[$childContent['order']]['content'] = $contentData;
                } else {
                    $children['columns'][$childContent['column'] - 1]['children'][$childContent['order']]['content'] = $contentData;
                }
            }
        }

        if (array_key_exists('columns', $children) && $children['columns'] != null) {
            foreach ($children['columns'] as $idx => $column) {
                ksort($children['columns'][$idx]['children']);
            }
        }

        if ($root && $container['LayoutType']['id'] != null) {
            $copy = $children;
            $children = array();
            $children[] = $copy;
        }

        return $children;
    }

    private function findPage($url)
    {
        $page = $this->Page->findByName('/' . $url);
        if ($url == '' && $page == null) {
            return null;
        }
        if ($page == null) {
            $urlParts = explode('/', $url);
            array_pop($urlParts);
            return $this->findPage(implode('/', $urlParts));
        } else {
            return $page;
        }
    }

    public function delete($id = null)
    {
        $this->PermissionValidation->actionAllowed(null, 'LayoutManager',true);

        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Page->id = $id;
        if (!$this->Page->exists()) {
            throw new NotFoundException(__('Invalid menu entry'));
        }
        $this->Page->delete();
    }

    function json($id)
    {
        $this->PermissionValidation->actionAllowed(null, 'LayoutManager',true);

        $data = $this->Page->findById($id);
        $page['Page'] = $data['Page'];
        $page['Page']['id'] = $page['Page']['id'];
        $page['Page']['name'] = $page['Page']['title'];
        $page['Container'] = $data['Container'];
        $this->layout = 'ajax';
        $this->response->type('json');
        $jsonString = json_encode($page);
        $this->set('page', $jsonString);
    }
}

