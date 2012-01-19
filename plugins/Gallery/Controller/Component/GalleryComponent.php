<?php
class GalleryComponent extends Component {
	public $uses = array ('Gallery.GalleryEntry');
	
 public function getData($controller, $params, $url, $id)
    {
        $data = array();
        return $data;
    }
    
	public function getGallery($controller, $galleryId){
		$controller->loadModel('Gallery.GalleryEntry');
		$gallery = $controller->GalleryEntry->findById($galleryId);
		debug($gallery);
		return $gallery;
	}
	
    
	public function getAllGalleries($controller){
		$controller->loadModel('Gallery.GalleryEntry');
		$galleries = $controller->GalleryEntry->find('all');
		print_r($galleries);
		
		//foreach ($pictures as &$picture){
			//$picture = $this->normalizePicture($picture);
		//}	
		
		return $galleries;
	}
	
	public function delete($controller, $galleryId){
		debug($galleryId);
		//unlink(realpath("../..".$picture['path_to_pic']));
		$controller->loadModel('Gallery.GalleryEntry');
		$controller->GalleryEntry->delete($galleryId);
	}
	

}