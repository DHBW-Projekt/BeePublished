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
	
	
	/**
	 * Method is called from the add image form
	 * transforms the form input for internal procession
	 * Enter description here ...
	 */
	public function uploadImage($contentId){
		//debug($this->request);
		
		$image = array('name' => $this->data['addImage']['File']['name'],
								'tmp_name' => $this->data['addImage']['File']['tmp_name'],
								'size' => $this->data['addImage']['File']['size'],
								'title' => $this->data['addImage']['Title']);
		$this->addImageInternal($image);
		$this->Session->setFlash('Image saved');
		
		$this->redirect($this->referer());
	}
	
	/**
	 * Method is called from the add images form
	 * transforms the form input for internal procession
	 */
	public function uploadImages($contentId){
		//debug($this->request);
		
		for($i = 0;$i<count($this->params['form']['files']['name']);$i++){
			//echo $i;
			$image = array('name' => $this->params['form']['files']['name'][$i],
							'tmp_name' => $this->params['form']['files']['tmp_name'][$i],
							'size' => $this->params['form']['files']['size'][$i],
							'title' => $this->params['form']['files']['name'][$i]
			);
			$this->addImageInternal($image);
		}
		
		$this->Session->setFlash('Images saved');
		
		$this->redirect($this->referer());
		
	}
	
	public function create($contentId){
		$data = array('ContentId' => $contentId );
		$this->set('data',$data);
	}
	
	/**
	 * processes a new uploaded umade
	 * Structure:
	 * Image:
	 * 	[name]
	 * 	[tmp_name]
	 * 	[size]
	 * 	[title]
	 * @param unknown_type $image
	 */
	private function addImageInternal($image){
		
		//debug($image);
		
		$dest = realpath("../../app/webroot/img/gallery").'/'.$image['name'];
		
		$image_source = imagecreatefromjpeg($image['tmp_name']);
		
		$exif = exif_read_data($image['tmp_name']);
		
		// Output
		imagejpeg($image_source,$dest, 100);
		
		// save to db
		$dbImage = array(
					'title' => $image['title'],
					'path_to_pic' => "/app/webroot/img/gallery/".$image['name'] );
		
		//debug($dbImage);
		
		$this->GalleryPictureComp->generateThumbnail($dbImage);
		$this->GalleryPictureComp->save($this,$dbImage);
	}
	
	public function delete($pictureId, $contentId){
		$this->deletePictureInternal($pictureId);
		$this->Session->setFlash('Image deleted');
		$this->redirect($this->referer());
	}
	
	public function deleteSelected($contentId){
		foreach($this->data['selectPictures'] as $imageId => $toBeDeleted){
			if($toBeDeleted == 1){
				$this->deletePictureInternal($imageId);
			}
		}
		$this->Session->setFlash('Images deleted');
		$this->redirect($this->referer());
	}
	
	private function deletePictureInternal($pictureID){
		$picture = $this->GalleryPictureComp->delete($this,$pictureID);
	}

	public function edit($pictureId,$contentId){
		$picture = $this->GalleryPictureComp->getPicture($this,$pictureId);
		
		$data = array(	'Picture' => $picture,
						'ContentId' => $contentId );
		
		$this->set('data',$data);		
	}
	
	public function save($contentId){
	
		$this->GalleryPictureComp->save($this,$this->data['GalleryPicture']);
		$this->redirect(array('action' => 'index', $contentId));
	}
	
}