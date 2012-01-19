<?php
class GalleryPictureComponent extends Component
{
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
	
	public function save($controller, $picture){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->save($picture);
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
	
	private function normalizePicture($picture){
		return $picture['GalleryPicture'];
	}
	
	public function generateThumbnail($picture){
		
		//debug($picture);
		
		$sourceSize = getimagesize(realpath("../..".$picture['path_to_pic']));
		
		//debug($sourceSize);
		
		$pathInfo = pathinfo(realpath("../..".$picture['path_to_pic']));
		
		//debug($pathInfo);
		
		$thumbPath = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
		                                   
		// Resample
		$image_thumb = imagecreatetruecolor(300, 200);
		$image_source = imagecreatefromjpeg(realpath("../..".$picture['path_to_pic']));
		imagecopyresampled($image_thumb, $image_source, 0, 0, 0, 0, 300, 200, $sourceSize[0], $sourceSize[1]);
		
		// Output
		imagejpeg($image_thumb, $thumbPath, 100);
	}
	
}