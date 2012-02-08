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
 * @description Basic Settings for all controllers
 */
class AppController extends Controller
{

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => '/',
            'logoutRedirect' => '/',
            'loginAction' => array('controller' => 'Users', 'action' => 'login')
        ),
        'PermissionValidation',
        'Config',
        'RequestHandler'
    );

    public $helpers = array('Html', 'Form', 'Session', 'Js', 'PermissionValidation');

    public $viewClass = 'Theme';

    function beforeFilter()
    {
        $this->theme = $this->Config->getValue('active_template');
        $this->set('mobile',$this->RequestHandler->isMobile());
        $this->set('design', $this->Config->getValue('active_design'));
        $this->Session->write('Config.language', Configure::read('Config.language'));
    }

    function afterFilter()
    {
        $this->_deleteValidation();
    }

    //Keep validation information even after redirect
    function _persistValidation()
    {
        $args = func_get_args();
        foreach ($args as $modelName) {
            if (!empty($this->{$modelName}->validationErrors) || !empty($this->{$modelName}->data)) {
                $this->Session->write('Validation.' . $modelName, array(
                    'controller' => $this->name,
                    'data' => $this->{$modelName}->data,
                    'validationErrors' => $this->{$modelName}->validationErrors
                ));
            }
        }
    }

    function _deleteValidation()
    {
        $this->Session->delete('Validation');
    }
}
