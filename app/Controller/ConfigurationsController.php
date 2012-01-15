<?php
App::uses('Folder', 'Utility');

class ConfigurationsController extends AppController
{

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'GeneralConfiguration', true);
    }

    public function index()
    {
        $this->layout = 'overlay';

        $config = $this->Configuration->find('first');

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
            $this->Configuration->id = $config['Configuration']['id'];
            if ($this->Configuration->save($this->request->data)) {
                $this->Session->setFlash('Successfully saved');
            } else {
                $this->Session->setFlash('Saving failed');
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->request->data = $config;
        }

        $themeFolder = new Folder(APP . 'View' . DS . 'themed');
        list($themes, $files) = $themeFolder->read();
        $themesSelect = array();
        foreach ($themes as $theme) {
            $themesSelect[$theme] = $theme;
        }

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
        $designFolder = new Folder(APP . 'View' . DS . 'themed' . DS . $template . DS . 'webroot' . DS . 'css' . DS . 'designs');
        list($folders, $designs) = $designFolder->read();
        $designsSelect = array();
        foreach ($designs as $design) {
            $design = substr($design, 0, -4);
            $designsSelect[$design] = $design;
        }
        return $designsSelect;
    }
}

?>
