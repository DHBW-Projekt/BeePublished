<?php

class ConfigurationsController extends AppController
{

    public $uses = array('Configuration');

// 	public $helpers = array('');
// 	public $components = array('');

    function beforeFilter()
    {
        //Actions which don't require authorization
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    public function index()
    {

        $this->set('title_for_layout', __('Current configuration'));

        // after creating database it has no entry -> prepare for entering values
        $allConfigurations = $this->Configuration->find('all');
        if (!array_key_exists('0', $allConfigurations)) {
            $this->Configuration->save($this->Configuration->create());
        }

        //Only one configuration is possible - set id
        $this->Configuration->id = $allConfigurations[0]['Configuration']['id'];

        // find all Templates and Designs -> see function
        $files = $this->findFiles();
        $designs = $files['designs'];
        $templates = $files['templates'];

        // set variables for display
        $this->set('designs', $designs);
        $this->set('templates', $templates);
        if ($this->request->is('get')) {

            // read data
            $this->request->data = $this->Configuration->read();

            // check whether design and template is set
            // change request data so select boxes work correctly (name to id)
            if (!empty($this->request->data['Configuration']['activeDesign'])) {
                $design_name = $this->request->data['Configuration']['activeDesign'];
                $design_keys = array_keys($designs, $design_name);
                $this->request->data['Configuration']['activeDesign'] = $design_keys[0];
            }
            if (!empty($this->request->data['Configuration']['activeTemplate'])) {
                $template_name = $this->request->data['Configuration']['activeTemplate'];
                $template_keys = array_keys($templates, $template_name);
                $this->request->data['Configuration']['activeTemplate'] = $template_keys[0];
            }

        } //if
        else
        {
            // 			die(debug($this->request->data));
            // change request data for save (id to name)
            if (!empty($this->request->data['Configuration']['activeDesign'])) {
                $design_id = $this->request->data['Configuration']['activeDesign'];
                $this->request->data['Configuration']['activeDesign'] = $designs[$design_id];
            }
            if (!empty($this->request->data['Configuration']['activeTemplate'])) {
                $template_id = $this->request->data['Configuration']['activeTemplate'];
                $this->request->data['Configuration']['activeTemplate'] = $templates[$template_id];
            }

            // save data
            if ($this->Configuration->save($this->request->data)) {
                $this->Session->setFlash('Your data has been updated.');
                $this->redirect(array('action' => 'index'));
            }
        } //else
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
