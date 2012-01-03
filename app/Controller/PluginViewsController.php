<?php
App::uses('AppController', 'Controller');
/**
 * PluginViews Controller
 *
 * @property PluginView $PluginView
 */
class PluginViewsController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $role = $this->Permission->getUserRoleId();
        if ($role != 6 && $role != 7) {
            $this->redirect($this->request->webroot);
        }
    }

    function json()
    {
        $data = $this->PluginView->find('all');
        $plugins = array();
        foreach ($data as $plugin) {
            $p = $plugin['PluginView'];
            $p['plugin'] = $plugin['Plugin']['name'];
            $plugins[] = $p;
        } // for
        $this->layout = 'ajax';
        $this->response->type('json');
        $jsonString = json_encode($plugins);
        $this->set('plugins', $jsonString);
    }

}
