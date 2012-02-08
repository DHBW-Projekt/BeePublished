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
 * @description Controller for CMS basic settings
 */

App::uses('Folder', 'Utility');

class ConfigurationsController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        //all methods are only available to user with appropriate permission
        $this->PermissionValidation->actionAllowed(null, 'GeneralConfiguration', true);
    }

    public function index()
    {
        $this->layout = 'overlay';

        $config = $this->Configuration->find('first');

        //if no config entry exists a new one has to be created
        if (!$config) {
            $config = $this->Configuration->create();
            $config['config_name'] = 'default';
            $config['page_name'] = 'BeePublish';
            $config['status'] = true;
            $config['config_name'] = 'default';
            $config['active_design'] = 'default';
            $config['active_template'] = 'BeeDefault';
            $this->Configuration->save($config);
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            //Save configuration data
            $this->Configuration->id = $config['Configuration']['id'];
            if ($this->Configuration->save($this->request->data)) {
                $this->Session->setFlash(__('Successfully saved'));
            } else {
                $this->Session->setFlash(__('Saving failed'));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            //load configuration data
            $this->request->data = $config;
        }

        //read all available themes from themed dirctory
        $themeFolder = new Folder(APP . 'View' . DS . 'Themed');
        list($themes, $files) = $themeFolder->read();

        $themesSelect = array();
        foreach ($themes as $theme) {
            $themesSelect[$theme] = $theme;
        }

        //get all designs for selected template
        $designs = $this->getDesignsForTemplate($config['Configuration']['active_template']);

        $this->set('themes', $themesSelect);
        $this->set('designs', $designs);

    } //index()

    public function designs()
    {
        $name = $_GET['data']['Configuration']['active_template'];
        $this->layout = null;
        $this->set('designs', json_encode($this->getDesignsForTemplate($name)));
    }

    private function getDesignsForTemplate($template)
    {
        //scan folder
        $designFolder = new Folder(APP . 'View' . DS . 'Themed' . DS . $template . DS . 'webroot' . DS . 'css' . DS . 'designs');
        list($folders, $designs) = $designFolder->read();
        $designsSelect = array();
        foreach ($designs as $design) {
            //remove .css from design name
            $design = substr($design, 0, -4);
            $designsSelect[$design] = $design;
        }
        return $designsSelect;
    }
}

?>
