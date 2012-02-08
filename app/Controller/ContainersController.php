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
 * @description Controller for container backend functionality in layout manager
 */

App::uses('AppController', 'Controller');

class ContainersController extends AppController
{

    public $uses = array('Container', 'Page', 'Content', 'Plugin');
    public $components = array('CMSPlugin');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'LayoutManager', true);
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
        $container = $this->Container->findById($id);
        $oldContainer = $container['Container']['parent_id'];
        $oldOrder = $container['Container']['order'];
        $oldColumn = $container['Container']['column'];
        $this->Container->delete();
        //update positions of other containers and contents
        $this->Container->query('UPDATE containers SET `order` = `order`-1 WHERE parent_id=' . $oldContainer . ' AND `column`=' . $oldColumn . ' AND `order`>=' . $oldOrder);
        $this->Content->query('UPDATE contents SET `order` = `order`-1 WHERE container_id=' . $oldContainer . ' AND `column`=' . $oldColumn . ' AND `order`>=' . $oldOrder);

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
            //update other containers and contents to set new positions
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
        if (array_key_exists('columns', $container)) {
            foreach ($container['columns'] as $idx => $column) {
                ksort($container['columns'][$idx]['children']);
            }
        }
        return $container;
    }

}
