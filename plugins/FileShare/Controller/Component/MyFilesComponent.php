<?php

class MyFilesComponent extends Component
{

	function getData($controller, $params) {
		//$this->set('my_files', $this->MyFile->find('all'));
        $controller->loadModel("FileShare.MyFile");
        $controller->set('my_files', $controller->MyFile->findAllByOwner($controller->Auth->user('id')));
        $controller->loadModel("FileShare.MyFileConfig");
        $controller->set('my_files_config', $controller->MyFileConfig->find('list'));

	}
    
}


?>