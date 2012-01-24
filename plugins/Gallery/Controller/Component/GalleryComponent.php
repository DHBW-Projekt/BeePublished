<?php
class GalleryComponent extends Component {
	public $uses = array ('Gallery.GalleryEntry', 'Gallery.GalleryPicture');
	public $components = array('Gallery.GalleryPictureComp');
	
 public function getData($controller, $params, $url, $id)
    {
        $data = array();
        return $data;
    }
    
	public function getGallery($controller, $galleryId){
		$controller->loadModel('Gallery.GalleryEntry');
		$gallery = $controller->GalleryEntry->findById($galleryId);
		$this->normalizeGallery($controller, &$gallery);
		foreach($gallery['GalleryPicture'] as &$picture){
			//debug($picture);
			$this->GalleryPictureComp->normalizePicture(&$picture);
		}
		return $gallery;
	}
	
    
	public function getAllGalleries($controller){
		$controller->loadModel('Gallery.GalleryEntry');
		$galleries = $controller->GalleryEntry->find('all');

		foreach ($galleries as $gallery){
			$this->normalizeGallery($controller, &$gallery);
		}

		return $galleries;
	}
	
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
	
	public function save($controller, $gallery){
		$controller->loadModel('Gallery.GalleryEntry');
		$rc = $controller->GalleryEntry->save($gallery);
		return $rc;
	}
	
	private function normalizeGallery($controller, $gallery){
		if(isset($gallery['GalleryEntry']['gallery_picture_id']))
			$gallery['GalleryEntry']['titlepicture'] = $this->GalleryPictureComp->getPicture($controller, $gallery['GalleryEntry']['gallery_picture_id']);
		unset($gallery['GalleryPicture']['id']);
		unset($gallery['GalleryPicture']['title']);
		unset($gallery['GalleryPicture']['path_to_pic']);
		unset($gallery['GalleryPicture']['gallery_entry_id']);
	}
	
	

}