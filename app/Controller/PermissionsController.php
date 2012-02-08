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
 * @description Controller to manage permissions
 */

App::uses('AppController', 'Controller');

class PermissionsController extends AppController
{

    public $uses = array('Permission', 'Role');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'GeneralConfiguration', true);
    }

    public function index()
    {
        $this->layout = 'overlay';
        if (!empty($this->request->data)) {
            $this->Permission->saveAll($this->request->data['Permission']);
            $this->Session->setFlash(__('Successfully saved'));
        }
        else {
            $permissions = $this->Permission->find('all');
            $newPermissions = array();
            foreach($permissions as $idx=>$permission) {
                $newPermissions[$idx] = $permission;
                $newPermissions[$idx]['Permission']['plugin'] = $permission['Plugin']['name'];
            }
            $this->request->data['Permission'] = Set::combine($newPermissions, '{n}.Permission.id', '{n}.Permission');
        }
        $roles = $this->Role->find('list');
        $this->set('roles', $roles);
    }

}
