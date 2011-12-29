<?php
App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * @property Page $Page
 */
class PagesController extends AppController
{

    public $components = array('Menu');
    public $helpers = array('Html', 'Js' => array('Jquery'));
    public $uses = array('Page', 'Plugin', 'Container', 'LayoutType', 'Content', 'ContentValue', 'MenuEntry');

    function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

    function display()
    {
        $path = explode('/',$this->request->url);
        $this->set('adminMode', false);
        if (sizeof($path) > 0 && $path[0] == 'admin') {
            array_shift($path);
            //Check Admin rights
            if ($this->Auth->User('id') != null) {
                $this->set('adminMode', true);
            } else {
                $url = '/' . implode('/', $path);
                $this->redirect($url);
            }
        }
        $url = implode('/', $path);

        //Get page to display
        $page = $this->findPage($url);

        if (!$page) {
            echo "404 PAGE NOT FOUND";
            exit;
        }

        $pageUrl = $page['Page']['name'];
        $url = '/' . $url;
        $count = 1;
        $diff = substr($url, strlen($pageUrl));

        if (substr($diff, 0, 1) == '/') {
            $diff = substr($diff, 1);
        }

        //Find elements for page to display
        $elements = $this->setupPageElements($page['Container'], $diff, true);

        //Output data
        $this->set('menu', $this->Menu->buildMenu($this, NULL));
        $this->set('elements', $elements);
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

                $plugin = $this->Plugin->findById($childContent['plugin_id']);

                $name = $plugin['Plugin']['name'] . '.' . $childContent['view_name'];
                $contentData = array();
                if ($name != ".") {
                    $contentData['plugin'] = $plugin['Plugin']['name'];
                    $contentData['view'] = $childContent['view_name'];
                    $urlParts = explode('/', $diff);
                    if ($urlParts[0] == strtolower($plugin['Plugin']['name'])) {
                        array_shift($urlParts);
                        $url = $urlParts;
                    } else {
                        $url = null;
                    }
                    $contentData['viewData'] = $this->Components->load($name)->getData($this, $params, $url, $childContent['id']);
                    $contentData['id'] = $childContent['id'];
                }
                $children['columns'][$childContent['column'] - 1]['children'][$childContent['order']]['content'] = $contentData;
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
        if ($page == null) {
            $urlParts = explode('/', $url);
            array_pop($urlParts);
            return $this->findPage(implode('/', $urlParts));
        } else {
            return $page;
        }
    }
}

