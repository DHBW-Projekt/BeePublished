<?php

class MyFilesController extends FileShareAppController
{
    public $uses = array('FileShare.MyFileConfig', 'FileShare.MyFile');

    function upload()
    {

        if (!empty($this->request->data) && is_uploaded_file($this->request->data['MyFile']['File']['tmp_name'])) {

            $fileData = fread(fopen($this->data['MyFile']['File']['tmp_name'], "r"), $this->request->data['MyFile']['File']['size']);

            $this->request->data['MyFile']['filename'] = $this->request->data['MyFile']['File']['name'];
            $this->request->data['MyFile']['type'] = $this->request->data['MyFile']['File']['type'];
            $this->request->data['MyFile']['size'] = $this->request->data['MyFile']['File']['size'];
            $this->request->data['MyFile']['path'] = "uploads/" . $this->Auth->user('id') . "-" . $this->request->data['MyFile']['filename'];
            $this->request->data['MyFile']['owner'] = $this->Auth->user('id');
            // Check if file exists
            if (file_exists($this->request->data['MyFile']['path'])) {
                $this->Session->setFlash(__d('file_share','A file with the specified name already exists!'), 'default', array(
                                                                                                           'class' => 'flash_failure'));
                $this->redirect($this->referer());
            }
            // Write file to disk
            $fh = fopen($this->request->data['MyFile']['path'], 'w') or die();
            fwrite($fh, $fileData);
            fclose($fh);

            if ($this->MyFile->save($this->request->data)) {
                $this->Session->setFlash(__d('file_share','The file with the filename ' . $this->request->data['MyFile']['filename'] . ' has been uploaded.'));

            } else {
                $this->Session->setFlash(__d('file_share','Unable to upload your file'), 'default', array(
                                                                                       'class' => 'flash_failure'));
            }
        }

        if ($this->request->data['MyFile']['File']['error'] == 4) {
            $this->Session->setFlash(__d('file_share','No file selected!'), 'default', array(
                                                                          'class' => 'flash_failure'));
        } else {
        $this->Session->setFlash(__d('file_share','Your file is bigger than ') . ini_get(post_max_size), 'default', array(
                                                                          'class' => 'flash_failure'));
        }
        
        $this->redirect($this->referer());

    }

    function download($id)
    {

        $contentValues = $this->MyFileConfig->find('list');

        if (array_key_exists('Cryptkey', $contentValues)) {
            $ck = $contentValues['Cryptkey'];
        } else {
            $ck = "nothing";
        }
        if (array_key_exists('Expire time', $contentValues)) {
            $et = $contentValues['Expire time'];
        } else {
            $et = 0;
        }

        $temp = explode("|", $this->decrypt($id, $ck));
        $id = $temp[0];
        $exp = $temp[1];
        if ($exp != "" && (time() - $exp) > $et) {
            echo time() - $exp;
            exit();
        }
        $file = $this->MyFile->findById($id);
        $filename = $file['MyFile']['filename'];
        $filesize = $file['MyFile']['size'];

        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Length: $filesize");

        readfile($file['MyFile']['path']);
        exit();

    }

    function delete($id)
    {
        $file = $this->MyFile->findById($id);
        if ($file['MyFile']['owner'] != $this->Auth->user('id') && $this->Auth->user('role_id') < 6) {
            $this->Session->setFlash(__d('file_share','You don\'t have permissions to delete ') . $file['MyFile']['filename'], 'default', array(
                                                                                                                             'class' => 'flash_failure'));
            $this->redirect($this->referer());
        }
        if (unlink($file['MyFile']['path']) && $this->MyFile->delete($id)) {
            $this->Session->setFlash(__d('file_share','The file ' . $file['MyFile']['filename'] . ' has been deleted.'));
            $this->redirect($this->referer());
        }
        $this->Session->setFlash(__d('file_share','An error occurred while deleting ') . $file['MyFile']['filename'], 'default', array(
                                                                                                                    'class' => 'flash_failure'));
        $this->redirect($this->referer());
    }

    public function beforeFilter()
    {
        parent::beforeFilter();

        //Actions which don't require authorization
        $this->Auth->allow('download');
    }

    public function admin()
    {
        $this->layout = 'overlay';

        if ($this->request->is('post')) {
            $this->MyFileConfig->read(null, 'Cryptkey');
            $this->MyFileConfig->set('value', $this->request->data['null']['Cryptkey']);
            $this->MyFileConfig->set('key', 'Cryptkey');
            $this->MyFileConfig->save();
            $this->MyFileConfig->read(null, 'Expire time');
            $this->MyFileConfig->set('value', $this->request->data['null']['Expire time']);
            $this->MyFileConfig->set('key', 'Expire time');
            $this->MyFileConfig->save();
            $this->Session->setFlash(__d('file_share','Saved successfully'));
        }

        $contentValues = $this->MyFileConfig->find('list');

        if (array_key_exists('Cryptkey', $contentValues)) {
            $ck = $contentValues['Cryptkey'];
        } else {
            $ck = "nothing";
        }
        if (array_key_exists('Expire time', $contentValues)) {
            $et = $contentValues['Expire time'];
        } else {
            $et = 0;
        }
        if (empty($this->request->data)) {
            $this->request->data = array(
                'null' => array(
                    'Cryptkey' => $ck,
                    'Expire time' => $et
                )
            );
        }
    }

    public function decrypt($value, $ck)
    {

        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $ck, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

    public function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}


?>