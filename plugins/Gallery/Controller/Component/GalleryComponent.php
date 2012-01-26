<?php
class GalleryComponent extends Component {
	public $uses = array ('Gallery.GalleryEntry', 'Gallery.GalleryPicture');
	public $components = array('Gallery.GalleryPictureComp');
	
	/**
	 * loads a gallery from db
	 * Enter description here ...
	 * @param unknown_type $controller
	 * @param unknown_type $galleryId
	 */
	public function getGallery($controller, $galleryId){		
		$controller->loadModel('Gallery.GalleryEntry');	
		$gallery = $controller->GalleryEntry->findById($galleryId);		
		$this->normalizeGallery($controller, &$gallery);
		if(isset($gallery['GalleryPicture']))
			foreach($gallery['GalleryPicture'] as &$picture)
				$this->GalleryPictureComp->normalizePicture(&$picture);
		return $gallery;
	}
	
    /**
     * loads all galleries from db
     * Enter description here ...
     * @param unknown_type $controller
     */
	public function getAllGalleries($controller){
		$controller->loadModel('Gallery.GalleryEntry');
		$galleries = $controller->GalleryEntry->find('all');

		foreach ($galleries as &$gallery){
			$this->normalizeGallery($controller, &$gallery);
			if(isset($gallery['GalleryPicture']))
				foreach($gallery['GalleryPicture'] as &$picture)
					$this->GalleryPictureComp->normalizePicture(&$picture);
		}

		return $galleries;
	}
	
	/**
	 * deletes a gallery
	 * Enter description here ...
	 * @param unknown_type $controller
	 * @param unknown_type $galleryId
	 */
	public function delete($controller, $galleryId){
		$controller->loadModel('Gallery.GalleryEntry');
		$pictures_to_save = array();
		$test = $controller->GalleryEntry->findById($galleryId);

		for($i = 0; $i < sizeof($test['GalleryPicture']); $i++){
			if(array_key_exists($i, $test['GalleryPicture'])){
				$pictures_to_save[$i] = $test['GalleryPicture'][$i];
				$pictures_to_save[$i]['gallery_entry_id'] = null;
			}
		}

		$controller->GalleryEntry->delete($galleryId);
		$controller->loadModel('Gallery.GalleryPicture');
		
		$controller->GalleryPicture->saveAll($pictures_to_save);
	}
	
	/**
	 * saves a gallery
	 * Enter description here ...
	 * @param unknown_type $controller
	 * @param unknown_type $gallery
	 */
	public function save($controller, $gallery){
		$controller->loadModel('Gallery.GalleryEntry');
		$rc = $controller->GalleryEntry->save($gallery);
		return $rc;
	}
	
	/**
	 * normalizes the gallery output (-> titlepicture structure)
	 * Enter description here ...
	 * @param unknown_type $controller
	 * @param unknown_type $gallery
	 */
	private function normalizeGallery($controller, $gallery){
		if(isset($gallery['GalleryEntry']['gallery_picture_id']))
			$gallery['GalleryEntry']['titlepicture'] = $this->GalleryPictureComp->getPicture($controller, $gallery['GalleryEntry']['gallery_picture_id']);
		unset($gallery['GalleryPicture']['id']);
		unset($gallery['GalleryPicture']['title']);
		unset($gallery['GalleryPicture']['path_to_pic']);
		unset($gallery['GalleryPicture']['gallery_entry_id']);
	}
}