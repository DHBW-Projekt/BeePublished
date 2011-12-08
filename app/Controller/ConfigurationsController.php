<?php

class ConfigurationsController extends AppController
{

    public $uses = array('Configuration');
//	public $helpers = array();
    public $components = array('FileFinder');

    function beforeFilter()
    {
        //Actions which don't require authorization
        parent::beforeFilter();
        $this->Auth->allow('index', 'add'); // allow('display','add',...)
    }

    public function index()
    {
        $this->set('title_for_layout', __('Current configuration'));
        $this->set('configurations', $this->Configuration->find('all'));

        $designs = $this->FileFinder->findDesigns();
        $this->set('designs', $designs);
        // 		$templates = $this->FileFinder->findTemplates();
        // 		$this->set('templates', $templates);


        if ($this->request->is('post')) {
            // 			$design_id = $this->request->data['Configuration']['design'];
            // 			$this->request->data['Configuration']['design'] = $designs[$design_id];
            // 			$template_id = $this->request->data['Configuration']['template'];
            // 			$this->request->data['Configuration']['template'] = $templates[$template_id];
            debug($this->request->data);


            if ($this->Configuration->save($this->request->data)) {
                $this->Session->setFlash('Your data has been updated.');
                $this->redirect(array('action' => 'index'));
            }
        }
    } //index()

    function add()
    {
        if ($this->request->is('post')) {
            debug($this->request->data);
            if ($this->Configuration->save($this->request->data)) {
                $this->Session->setFlash('Your post has been saved.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your post.');
            }
        }
    }


}

?>
