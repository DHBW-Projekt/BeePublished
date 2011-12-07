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

    function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }

    function display()
    {
        //Load required models
        $this->loadModel('Container');
        $this->loadModel('LayoutType');
        $this->loadModel('Content');
        $this->loadModel('ContentValue');
        $this->loadModel('MenuEntry');

        //Get page to display
        $page = $this->Page->findById(1);

        //Find elements for page to display
        $elements = $this->setupPageElements($page['Container'], true);

        //Output data
        $this->set('menu',$this->Menu->buildMenu($this,NULL));
        $this->set('elements', $elements);
    }

    private function setupPageElements($container, $root = false)
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
                    $children[$childContainer['order']] = $this->setupPageElements($childContainer);
                } else {
                    if ($root && $container['LayoutType']['id'] != null) {
                        $children[$childContainer['column'] - 1]['children'][$childContainer['order']] = $this->setupPageElements($childContainer);
                    } else {
                        $children['columns'][$childContainer['column'] - 1]['children'][$childContainer['order']] = $this->setupPageElements($childContainer);
                    }
                }
            }
        }

        if (array_key_exists('Content', $container) && sizeof($container['Content'] > 0)) {
            foreach ($container['Content'] as $childContent) {
                $contentValues = $this->ContentValue->findAllByContentId($childContent['id']);
                $params = array();
                foreach($contentValues as $contentValue) {
                    $params[$contentValue['ContentValue']['key']] = $contentValue['ContentValue']['value'];
                }
                $name = $childContent['module_name'].'.'.$childContent['view_name'];
                $contentData = array();
                if ($name != ".") {
                    $contentData['plugin'] = $childContent['module_name'];
                    $contentData['view'] = $childContent['view_name'];
                    $contentData['viewData'] = $this->Components->load($name)->getData($this, $params);
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
}

