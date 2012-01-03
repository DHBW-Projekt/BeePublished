<?php
App::uses('AppController', 'Controller');
/**
 * Contents Controller
 *
 * @property Content $Content
 */
class ContentsController extends AppController
{

    public $uses = array('Content', 'PluginView', 'Container');

    function beforeFilter()
    {
        parent::beforeFilter();
        $role = $this->Permission->getUserRoleId();
        if ($role != 6 && $role != 7) {
            $this->redirect($this->request->webroot);
        }
    }

    function add($parent, $column, $plugin, $order)
    {
        $this->autoLayout = false;
        if ($this->request->is('post')) {
            $this->Content->create();
            $this->Content->set('container_id', $parent);
            $this->Content->set('plugin_view_id', $plugin);
            $this->Content->set('column', $column);
            $this->Content->set('order', $order);
            $this->Content->save();
            $this->set('id', $this->Content->id);
        }
    }

    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException(__('Invalid content'));
        }
        $this->Content->delete();
    }

    public function newPosition($id, $newContainer, $newColumn, $newOrder)
    {
        $this->Content->id = $id;
        if (!$this->Content->exists()) {
            throw new NotFoundException(__('Invalid role'));
        }
        $content = $this->Content->findById($id);
        $oldContainer = $content['Content']['container_id'];
        $oldOrder = $content['Content']['order'];
        $oldColumn = $content['Content']['column'];
        if ($this->request->is('post')) {
            $this->Container->query('UPDATE containers SET `order` = `order`-1 WHERE parent_id=' . $oldContainer . ' AND `column`=' . $oldColumn . ' AND `order`>=' . $oldOrder);
            $this->Content->query('UPDATE contents SET `order` = `order`-1 WHERE container_id=' . $oldContainer . ' AND `column`=' . $oldColumn . ' AND `order`>=' . $oldOrder);
            $this->Container->query('UPDATE containers SET `order` = `order`+1 WHERE parent_id=' . $newContainer . ' AND `column`=' . $newColumn . ' AND `order`>=' . $newOrder);
            $this->Content->query('UPDATE contents SET `order` = `order`+1 WHERE container_id=' . $newContainer . ' AND `column`=' . $newColumn . ' AND `order`>=' . $newOrder);
            $this->Content->set('container_id', $newContainer);
            $this->Content->set('column', $newColumn);
            $this->Content->set('order', $newOrder);
            $this->Content->save($this->request->data);
        }
    }

    public function display($id)
    {
        $this->layout = 'reload';
        $content = $this->Content->findById($id);

        $params = array();
        foreach ($content['ContentValue'] as $contentValue) {
            $params[$contentValue['key']] = $contentValue['value'];
        }

        if ($content['PluginView']['id'] != null) {
            $plugin = $this->PluginView->findById($content['PluginView']['id']);
            $this->set('plugin', $plugin['Plugin']['name']);
            $this->set('view', $plugin['PluginView']['name']);
            $this->set('data', $this->Components->load($plugin['Plugin']['name'] . '.' . $plugin['PluginView']['name'])->getData($this, $params, null, $id));
            $this->set('adminMode', true);
            $this->set('id', $id);
        } else {
            $this->set('error', true);
        }
    }

}
