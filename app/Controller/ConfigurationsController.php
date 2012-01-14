<?php

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
            $config['active_template'] = 'default';
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

    } //index()

    private function findFiles()
    {
        $designs = array();
        $templates = array();
        $allFiles = scandir('../webroot/css'); // directory where css files are located, lists all files
        foreach ($allFiles as $file) {
            if (($file == '.') || ($file == '..')) {
                // these entries are not files -> don't list them
            }
            else if (strpos($file, 'design') !== false) {
                // change for other naming conventions
                $designs[] = $file;
            }
            else if (strpos($file, 'template') !== false) {
                // change for other naming conventions
                $templates[] = $file;
            }
        } //foreach
        // return an array with designs and templates
        return array('designs' => $designs, 'templates' => $templates);
    } //findFiles()
}

?>
