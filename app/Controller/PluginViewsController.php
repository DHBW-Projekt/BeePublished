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
 * @description Controller to manage plugin views in backend
 */

App::uses('AppController', 'Controller');

class PluginViewsController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'LayoutManager',true);
    }

    function json()
    {
        $data = $this->PluginView->find('all');
        $plugins = array();

        foreach ($data as $plugin) {
            $p = $plugin['PluginView'];
            $p['plugin'] = $plugin['Plugin']['name'];
            $p['img'] = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $p['plugin']) . '/img/pluginicons/' . $p['name'] . '_' . Configure::read('Config.language') .  '.png');
            $plugins[] = $p;
        } // for

        $this->layout = 'ajax';
        $this->response->type('json');
        $jsonString = json_encode($plugins);
        $this->set('plugins', $jsonString);
    }

}
