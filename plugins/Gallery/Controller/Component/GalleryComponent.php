<?php
class GalleryComponent extends Component {
	public $uses = array ('Gallery.GalleryEntry', 'Gallery.GalleryPicture');
	
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
		//debug($galleryId);
		//unlink(realpath("../..".$picture['path_to_pic']));
		
		$controller->loadModel('Gallery.GalleryEntry');
		$test = $controller->GalleryEntry->findById($galleryId);
		//$controller->loadModel('Gallery.GalleryPicture');
	//	for($i = 0; $i < sizeof($test['GalleryPicture']); $i++){
	//		echo $test['GalleryPicture'][$i];
	//	}
		
		foreach($test['GalleryPicture'] as $galleryPicture){
			//$galleryPicture['gallery_entry_id'] = null;
			//echo"test";
			//$controller->GalleryPicture->save($galleryPicture);
		}
		//$controller->GalleryEntry->saveAll($test);
		debug($test);
		//$controller->GalleryEntry->delete($galleryId);
		
	}
	
	public function save($controller, $gallery){
		$controller->loadModel('Gallery.GalleryEntry');
		$rc = $controller->GalleryEntry->save($gallery);
		return $rc;
	}
	
	

}