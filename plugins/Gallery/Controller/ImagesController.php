<?php
class ImagesController extends AppController{
	var $layout = 'overlay';
	
	public $uses = array('Gallery.GalleryPicture');

	public function index(){
		$existingImages = $this->GalleryPicture->find('all');
		//debug($existingImages);
		$this->set('allImages', $existingImages);
	}
	
	public function create(){
		
		//debug($this->data);
		
		$imageTitle = $this->data['addImage']['ImageTitle'];
		$image = $this->data['addImage']['File'];
		
		
		$dest = realpath("../../app/webroot/img/gallery").'\\'.$image['name'];
		$urlPath = "/app/webroot/img/gallery/".$image['name'];
		
		$source = fopen($image['tmp_name'], 'r');
		$target = fopen($dest,"w+");
		fwrite($target, fread($source, $image['size']));
		fclose($target);
		fclose($source);
		
		// save to db	
		
		$dbImage = array(
			'title' => $imageTitle,
			'path_to_pic' => $urlPath
		);
		
		$this->GalleryPicture->save($dbImage);
		$this->redirect(array(
						'action' => 'index'));
	}
	
	public function delete($id){
		// TODO remove from ftp
		$image = $this->GalleryPicture->findById($id);
		$image = $image['GalleryPicture'];
		
		unlink(realpath("../..".$image['path_to_pic']));
		
		$this->GalleryPicture->delete($id);
		$this->redirect($this->referer());
	}
	
	public function edit($id){
		$image = $this->GalleryPicture->findById($id);
		$image = $image['GalleryPicture'];
		$this->set('image', $image);
	}
	
	public function save(){
		$imageToSave = $this->data['GalleryImage'];
		$this->GalleryPicture->save($imageToSave);
		$this->redirect(array('action' => 'index'));
	}
}