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
 * @description Entry Controller for Display a Gallery
 */

class DisplayGalleryController extends AppController {
	
	var $components = array('ContentValueManager','Gallery.Gallery','Gallery.GalleryPictureComp');
	var $layout = 'overlay';
	
	/**
	 * Method redirects to Display Gallery Controller
	 * @param int $galleryId
	 */
	public function index($galleryId){
		$this->redirect(array('controller' => 'DisplayGallery', 'action' => 'index'));
	}
	
	public function admin($contentId){
		$this->redirect(array('action' => 'setGalleryAdminTab', $contentId, 'singleGallery'));
	}
	
	/**
	 * get the right Admin View
	 * @param int $contentId
	 * @param String $menue_context
	 */
	public function setGalleryAdminTab($contentId, $menue_context){
		$currentlyassigned =  $this->ContentValueManager->getContentValues($contentId);
		
		$allGalleries = $this->Gallery->getAllGalleries($this);

		$data = array(	'AllGalleries' => $allGalleries,
						'CurrGallery' => $currentlyassigned
		);
		
		$this->set('data',$data);
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
	}
	
	/**
	 * Assign Gallery to the view
	 * @param int $contentId
	 * @param String $menue_context
	 */
	public function setGallery($contentId, $galleryId, $menue_context){
		$this->ContentValueManager->saveContentValues($contentId, array('galleryID' => $galleryId));

		$this->Session->setFlash('Gallery sucessfully assigned');
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
		$this->redirect($this->referer());
	}
	

}