<?php
class ManageImagesController  extends AppController{
	var $layout = 'overlay';
	
	public $components = array('Gallery.GalleryPicture');

	/**
	 * Need to pass the content id -> user could switch back to the set set image tab
	 * @param int $contentId
	 */
	public function index($contentId){
		
		$allPics = $this->GalleryPicture->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
						'ContentId' => $contentId );
		
		$this->set('data',$data);
	}
	
	public function create($contentId){
		
		//debug($this->data);
		
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
			'title' => $this->data['addImage']['ImageTitle'],
			'path_to_pic' => $urlPath );
		
		$this->GalleryPicture->save($this,$dbImage);
		$this->redirect(array(
						'action' => 'index', $contentId));
	}
	
	public function delete($pictureId, $contentId){
		// TODO remove from ftp
		$picture = $this->GalleryPicture->delete($this,$pictureId);
		
		/*
		unlink(realpath("../..".$picture['path_to_pic']));
		
		$this->GalleryPicture->delete($id);
		*/
		$this->redirect($this->referer());
	}

	public function edit($pictureId,$contentId){
		$picture = $this->GalleryPicture->getPicture($this,$pictureId);
		
		$data = array(	'Picture' => $picture,
						'ContentId' => $contentId );
		
		$this->set('data',$data);		
	}
	
	public function save($contentId){
		//debug($this->data);
		//debug($contentId);
		
		$this->GalleryPicture->save($this,$this->data['GalleryPicture']);
		$this->redirect(array('action' => 'index', $contentId));
	}
	
}