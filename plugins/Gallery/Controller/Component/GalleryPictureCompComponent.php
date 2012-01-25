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
	
	public function getAllUnAssignedPictures($controller){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all',  array('conditions' => array( 'gallery_entry_id' => null)));
		//conditions =
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	public function getAllPicturesGallery($controller, $galleryId){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all',  array('conditions' => array( 'gallery_entry_id' => $galleryId)));
		
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	public function save($controller, $picture){
		$controller->loadModel('Gallery.GalleryPicture');
		$controller->GalleryPicture->create();
		$controller->GalleryPicture->save($picture);
	}
	
	public function delete($controller, $pictureId){
		$picture = $this->getPicture($controller, $pictureId);
		
//		debug($picture);
		
		
		
		// delete thumb
		
		$pathInfo = pathinfo(realpath("../..".$picture['path_to_pic']));
		
	//	debug($pathInfo);
		
		$thumbPath = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
		unlink($thumbPath);
		unlink(realpath("../..".$picture['path_to_pic']));
		
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->delete($picture);
	}
	
	public function normalizePicture($picture){
		
		//debug($picture);
		
		if(isset($picture['GalleryPicture']))
			$picture = $picture['GalleryPicture'];
		
		//debug($picture['path_to_pic']);
		
		$pathInfo = pathinfo($picture['path_to_pic']);
		
		//debug($pathInfo);
		
		$picture['thumb'] = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
	//	debug($picture);
		return $picture;
	}
	
	public function generateThumbnail($picture){
		
		// ziel: b: 160 / h: 120
		
		
		
		//debug($picture);
		
		$sourceSize = getimagesize(realpath("../..".$picture['path_to_pic']));
		
		
		$pathInfo = pathinfo(realpath("../..".$picture['path_to_pic']));
		
		
		$thumbPath = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
		                                   
		// Resample
		$image_thumb = imagecreatetruecolor(160, 120);
		$image_source = imagecreatefromjpeg(realpath("../..".$picture['path_to_pic']));
		
		
		$width = $sourceSize[0];
		$heigth = $sourceSize[1];
		
		$width_target = 1;
		$heigth_target = 1;
		
		if( $width/$heigth > 160/120){
			$heigth_target = $heigth;
			$width_target = $heigth / 120 * 160;
		} else {
		//	echo "else";
			$width_target = $width;
			$heigth_target = $width / 160 * 120;
		}
			
		
		//debug($width_target);
		//debug($heigth_target);
		
		imagecopyresampled($image_thumb, $image_source, 0, 0, 0, 0, 160, 120, $width_target, $heigth_target);
		
		// Output
		imagejpeg($image_thumb, $thumbPath, 80);
	}
	
}