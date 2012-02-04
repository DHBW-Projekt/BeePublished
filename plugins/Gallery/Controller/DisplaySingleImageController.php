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
 * @description controller to display a single image for facebook
 */

class DisplaySingleImageController extends GalleryAppController 
{
	public $components = array('Gallery.Gallery','Gallery.GalleryPictureComp');
		var $layout = 'overlay';
		
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('display');
	}
	
	/**
	 * is called for facebook like to display
	 *  a single image without any contex
	 * @param int $galleryid
	 * @param int  $pictureid
	 */
	public function display($galleryid, $pictureid){ 
		$image = $this->GalleryPictureComp->getPicture($this, $pictureid);
		
		$data = array(	'image' => $image,
		);
		$this->set('data',$data);
	}
}