<?php
App::uses('AppController', 'Controller');
/**
 * Containers Controller
 *
 * @property Container $Container
 */
class ContainersController extends AppController
{

    public $uses = array('Container', 'Page', 'Content', 'Plugin');
    public $components = array('CMSPlugin');

    function beforeFilter()
    {
        parent::beforeFilter();
        $role = $this->PermissionValidation->getUserRoleId();
        if ($role != 6 && $role != 7) {
            $this->redirect($this->request->webroot);
        }
    }

    function add($parent, $column, $type, $order)
    {
        $this->autoLayout = false;
        if ($this->request->is('post')) {
            $this->Container->create();
            $this->Container->set('parent_id', $parent);
            $this->Container->set('layout_type_id', $type);
            $this->Container->set('column', $column);
            $this->Container->set('order', $order);
            $this->Container->save();
            $this->set('id', $this->Container->id);
        }
    }

    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Container->id = $id;
        if (!$this->Container->exists()) {
            throw new NotFoundException(__('Invalid container'));
        }
        $this->Container->delete();
        $this->render('json');
    }

    public function newPosition($id, $newContainer, $newColumn, $newOrder)
    {
        $this->Container->id = $id;
        if (!$this->Container->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $container = $this->Container->findById($id);
        $oldContainer = $container['Container']['parent_id'];
        $oldOrder = $container['Container']['order'];
        $oldColumn = $container['Container']['column'];
        if ($this->request->is('post')) {
            $this->Container->query('UPDATE containers SET `order` = `order`-1 WHERE parent_id=' . $oldContainer . ' AND `column`=' . $oldColumn . ' AND `order`>=' . $oldOrder);
            $this->Content->query('UPDATE contents SET `order` = `order`-1 WHERE container_id=' . $oldContainer . ' AND `column`=' . $oldColumn . ' AND `order`>=' . $oldOrder);
            $this->Container->query('UPDATE containers SET `order` = `order`+1 WHERE parent_id=' . $newContainer . ' AND `column`=' . $newColumn . ' AND `order`>=' . $newOrder);
            $this->Content->query('UPDATE contents SET `order` = `order`+1 WHERE container_id=' . $newContainer . ' AND `column`=' . $newColumn . ' AND `order`>=' . $newOrder);
            $this->Container->set('parent_id', $newContainer);
            $this->Container->set('column', $newColumn);
            $this->Container->set('order', $newOrder);
            $this->Container->save($this->request->data);
        }
        $this->render('json');
    }

    function json($pageid)
    {
        $page = $this->Page->findById($pageid);
        $containerid = $page['Container']['id'];

        $root = $this->Container->findById($containerid);

        $container = $this->createData($root['Container'], $root['LayoutType']);
        $this->layout = 'ajax';
        $this->response->type('json');

        $jsonString = json_encode($container);
        $this->set('data', $jsonString);
    }

    private function createData($container, $layout)
    {
        if ($layout['id'] != null) {
            $widths = explode(':', $layout['weight']);
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
                $container['columns'][$idx + 1]['class'] = $class;
                $container['columns'][$idx + 1]['contentClass'] = $contentClass;
                $container['columns'][$idx + 1]['children'] = array();
            }
        }

        $children = $this->Container->findAllByParentId($container['id'], null, array('Container.order' => 'ASC'));
        foreach ($children as $child) {
            $container['columns'][$child['Container']['column']]['children'][$child['Container']['order']] = $this->createData($child['Container'], $child['LayoutType']);
        }

        $contents = $this->Content->findAllByContainerId($container['id'], null, array('Content.order' => 'ASC'));
        foreach ($contents as $content) {
            $plugin = $this->Plugin->findById($content['PluginView']['plugin_id']);
            $container['columns'][$content['Content']['column']]['children'][$content['Content']['order']] = $content['Content'];
            $container['columns'][$content['Content']['column']]['children'][$content['Content']['order']]['Plugin'] = $plugin['Plugin'];
        }
        return $container;
    }

}
