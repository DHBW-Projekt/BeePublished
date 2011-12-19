<?php
/**
 * Created by JetBrains PhpStorm.
 * User: DEU132821
 * Date: 15.12.11
 * Time: 10:55
 * To change this template use File | Settings | File Templates.
 */

// app/controllers/my_files_controller.php (Cake 1.2)
class MyFilesController extends FileShareAppController
{
    function upload()
    {
        if (!empty($this->request->data) && is_uploaded_file($this->request->data['MyFile']['File']['tmp_name'])) {
            // $fileData = fread(fopen($this->data['File']['File']['tmp_name'], "r"), $this->data['File']['File']['size']);

            $this->request->data['MyFile']['filename'] = $this->request->data['MyFile']['File']['name'];
            $this->request->data['MyFile']['type'] = $this->request->data['MyFile']['File']['type'];
            $this->request->data['MyFile']['size'] = $this->request->data['MyFile']['File']['size'];
            // Write file to disk
            //$this->data['File']['data'] = $fileData;

            $this->request->data['MyFile']['path'] = "kjklkjlkj";

            if ($this->MyFile->save($this->request->data)) {
                $this->Session->setFlash('The file with id ' . $this->request->data['MyFile']['filename'] . ' has been uploaded.' );
            } else {
                $this->Session->setFlash('Unable to upload your file');
            }

            //$this->redirect('somecontroller/someaction');
        }
    }

    function download($id)
    {

        $file = $this->MyFile->findById($id);
        $this->redirect($file['MyFile']['path']);

        exit();
    }

    function index($owner = null) {
        $this->set('my_files', $this->MyFile->find('all'));
    }

    function delete($id){
        if ($this->MyFile->delete($id)) {
            $this->Session->setFlash('The file with id ' . $id . ' has been deleted.' );
            $this->redirect(array('controller' => 'my_files', 'action' => 'index'));
        }
        exit();
    }

    public function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('*');
    }
}


?>