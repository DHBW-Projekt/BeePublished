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
 * @description Entry Controller for display images
 */

class DisplayImageController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.GalleryPictureComp');
	
	/**
	 * Is called when 
	 * @param unknown_type $contentId
	 */
	public function admin($contentId){		
		$this->redirect(array('action' => 'setImageAdminTab', $contentId,'singleImage'));
		
	}
	
	/**
	 * get the right admin tab
	 * @param int $contentId
	 * @param string $menue_context
	 */
	public function setImageAdminTab($contentId,$menue_context){
		$this->layout = 'overlay';
		$currentlyassigned =  $this->ContentValueManager->getContentValues($contentId);
		
		$allPics = $this->GalleryPictureComp->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics,
						'CurrPicture' => $currentlyassigned );
		
		$this->set('data',$data);
		$this->set('mContext',$menue_context);	
		$this->set('ContentId',$contentId);
	}
	
	/**
	 * Assign the image to the view
	 * @param int $contentId
	 * @param int $pictureId
	 * @param string $menue_context
	 */
	public function setImage($contentId, $pictureId, $menue_context){
		$this->ContentValueManager->saveContentValues($contentId, array('pictureID' => $pictureId));
		$this->Session->setFlash('Image sucessfully assigned');
		$this->set('mContext',$menue_context);	
		$this->set('ContentId',$contentId);
		$this->redirect($this->referer());
	}
	
}