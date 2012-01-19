<?php
class ManageImagesController  extends AppController{
	var $layout = 'overlay';
	
	public $components = array('Gallery.GalleryPictureComp');

	/**
	 * Need to pass the content id -> user could switch back to the set set image tab
	 * @param int $contentId
	 */
	public function index($contentId){
		
		$allPics = $this->GalleryPictureComp->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
						'ContentId' => $contentId );
		
		$this->set('data',$data);
	}
	
	public function create($contentId){
		
		//debug($this->data);
		
		$image = $this->data['addImage']['File'];
		
		$dest = realpath("../../app/webroot/img/gallery").'/'.$image['name'];
		$urlPath = "/app/webroot/img/gallery/".$image['name'];
		
		$source = fopen($image['tmp_name'], 'r');
		$target = fopen($dest,"w+");
		fwrite($target, fread($source, $image['size']));
		fclose($target);
		fclose($source);
		
		// save to db	
		$dbImage = array(
			'title' => $this->data['addImage']['Title'],
			'path_to_pic' => $urlPath );
		
		$this->GalleryPictureComp->save($this,$dbImage);
		
		
		$this->Session->setFlash('Image saved');
		

		$this->redirect(array(
						'action' => 'index', $contentId));
	
	}
	
	public function delete($pictureId, $contentId){

		// TODO remove from ftp
		$picture = $this->GalleryPictureComp->delete($this,$pictureId);


		
		$this->Session->setFlash('Image deleted');
		
		$this->redirect($this->referer());
	}

	public function edit($pictureId,$contentId){
		$picture = $this->GalleryPictureComp->getPicture($this,$pictureId);
		
		$data = array(	'Picture' => $picture,
						'ContentId' => $contentId );
		
		$this->set('data',$data);		
	}
	
	public function save($contentId){
		//debug($this->data);
		//debug($contentId);
		
		$this->GalleryPictureComp->save($this,$this->data['GalleryPicture']);
		$this->redirect(array('action' => 'index', $contentId));
	}
	
}