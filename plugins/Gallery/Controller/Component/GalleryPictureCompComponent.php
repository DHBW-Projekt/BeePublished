<?php
class GalleryPictureCompComponent extends Component
{
	public $uses = array ('Gallery.GalleryPicture');
	
	public function getPicture($controller, $pictureId){
		$controller->loadModel('Gallery.GalleryPicture');
		$picture = $controller->GalleryPicture->findById($pictureId);
		
		$picture = $this->normalizePicture($picture);
		
		return $picture;
	}
	
	public function getAllPictures($controller){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all');
		
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	public function getAllPicturesGallery($controller, $galleryId){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all');
		
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	public function save($controller, $picture){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->save($picture);
	}
	
	public function delete($controller, $pictureId){
		$picture = $this->getPicture($controller, $pictureId);
		
		unlink(realpath("../..".$picture['path_to_pic']));
		
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->delete($picture);
	}
	
	private function normalizePicture($picture){
		return $picture['GalleryPicture'];
	}
	
	
}