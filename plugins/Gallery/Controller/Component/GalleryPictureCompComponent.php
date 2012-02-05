<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Alexander Müller & Fabian Kajzar
 * 
 * @description Component that capsulates basic operations on image objects
 */

class GalleryPictureCompComponent extends Component
{
	public $uses = array ('Gallery.GalleryPicture');
	
	/**
	 * loads a picture from db
	 * @param unknown_type $controller
	 * @param unknown_type $pictureId
	 */
	public function getPicture($controller, $pictureId){
		$controller->loadModel('Gallery.GalleryPicture');
		$picture = $controller->GalleryPicture->findById($pictureId);
		
		$picture = $this->normalizePicture($picture);
		
		return $picture;
	}
	
	/**
	 * loads all pictures from db
	 * @param unknown_type $controller
	 */
	public function getAllPictures($controller){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all');
		
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	/**
	 * loads unasigned pictures
	 * @param unknown_type $controller
	 */
	public function getAllUnAssignedPictures($controller){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all',  array('conditions' => array( 'gallery_entry_id' => null)));
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	/**
	 * load pictures of gallery
	 * @param unknown_type $controller
	 * @param unknown_type $galleryId
	 */
	public function getAllPicturesGallery($controller, $galleryId){
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->find('all',  array('conditions' => array( 'gallery_entry_id' => $galleryId)));
		
		foreach ($pictures as &$picture){
			$picture = $this->normalizePicture($picture);
		}
		
		return $pictures;
	}
	
	/**
	 * save the picture to db
	 * @param unknown_type $controller
	 * @param unknown_type $picture
	 */
	public function save($controller, $picture){
		$controller->loadModel('Gallery.GalleryPicture');
		$controller->GalleryPicture->create();
		$controller->GalleryPicture->save($picture);
	}
	
	/**
	 * deletes the picture
	 * @param unknown_type $controller
	 * @param unknown_type $pictureId
	 */
	public function delete($controller, $pictureId){
		$picture = $this->getPicture($controller, $pictureId);
		
		$pathInfo = pathinfo(realpath($picture['path_to_pic']));
	
		$thumbPath = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
		
		unlink($thumbPath);
		
		unlink(realpath($picture['path_to_pic']));
		
		$controller->loadModel('Gallery.GalleryPicture');
		$pictures = $controller->GalleryPicture->delete($picture);
	}
	
	/**
	 * normalizes the picture output -> add thumb path
	 * @param unknown_type $picture
	 */
	public function normalizePicture($picture){
		if(isset($picture['GalleryPicture']))
		$picture = $picture['GalleryPicture'];
		
		$pathInfo = pathinfo($picture['path_to_pic']);	
		
		$picture['thumb'] = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
		return $picture;
		
	}
	
	/**
	 * gemerates a thumbnail for the picture
	 * @param unknown_type $picture
	 */
	public function generateThumbnail($picture){
	
		$sourceSize = getimagesize(realpath($picture['path_to_pic']));
		$pathInfo = pathinfo(realpath($picture['path_to_pic']));
		
		if(!file_exists($pathInfo['dirname'].'/thumb')){
			mkdir($pathInfo['dirname'].'/thumb');
		}
		
		$thumbPath = $pathInfo['dirname']."/thumb/".$pathInfo['basename'];
		                                   
		// Resample
		$image_thumb = imagecreatetruecolor(160, 120);
		$image_source = imagecreatefromjpeg(realpath($picture['path_to_pic']));
		
		$width = $sourceSize[0];
		$heigth = $sourceSize[1];
		
		$width_target = 1;
		$heigth_target = 1;
		
		if( $width/$heigth > 160/120){
			$heigth_target = $heigth;
			$width_target = $heigth / 120 * 160;
		} else {
			$width_target = $width;
			$heigth_target = $width / 160 * 120;
		}
		imagecopyresampled($image_thumb, $image_source, 0, 0, 0, 0, 160, 120, $width_target, $heigth_target);
		imagejpeg($image_thumb, $thumbPath, 80);
	}
	
}