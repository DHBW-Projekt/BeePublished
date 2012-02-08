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
 * @description Controller to manage all operations relating images
 */

class ManageImagesController  extends GalleryAppController{
	var $layout = 'overlay';
	
	public $components = array('Gallery.GalleryPictureComp');
	
	
	function beforeRender()
    {
        parent::beforeRender();

        //Get PluginId for PermissionsValidation Helper
        $pluginId = $this->getPluginId();
        $this->set('pluginId', $pluginId);
    }
	
    
	/**
	 * Need to pass the content id -> user could switch back to the set set image tab
	 * @param int $contentId
	 */
	public function index($contentId, $menue_context){
		
		$allPics = $this->GalleryPictureComp->getAllPictures($this);
		
		$data = array(	'AllPictures' => $allPics);
		
		$this->set('data',$data);
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
	}
	
	
	/**
	 * Method is called from the add image form
	 * transforms the form input for internal procession
	 * Enter description here ...
	 */
	 public function  strcontains($haystack,$needle) {  
      if  (strpos($haystack,$needle)!==false)  
        return true;  
      else  
        return false;  
    }  
    
	/**
	 * Uploads an imge and checks the context
	 * @param int $contentId
	 * @param int $menue_context
	 */
	public function uploadImage($contentId, $menue_context){
				
		// test if image is selected
		if($this->data['addImage']['File']['size'] == 0){
			$this->Session->setFlash('No file selected');
			$this->redirect($this->referer());
			return;
		}
		
		$pluginId = $this->getPluginId();
		$stringer = explode('.',$this->data['addImage']['File']['name'] );

		if($this->strcontains($stringer[0],'.')){
			// not allowed
			$this->Session->setFlash('Wrong filename');
			
		} else {
			//check File Format
			if($stringer[1]!="jpeg" && $stringer[1]!="jpg" && $stringer[1]!="JPEG" && $stringer[1]!="JPG"){
				
				$this->Session->setFlash('Wrong filetype, only JPG allowed');
			} else {
				$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
				$image = array('name' => $this->data['addImage']['File']['name'],
								'tmp_name' => $this->data['addImage']['File']['tmp_name'],
								'size' => $this->data['addImage']['File']['size'],
								'title' => $this->data['addImage']['Title']);
				
				if($image['title'] == ""){
					$image['title'] = $image['name'];
				}
				
				if($this->addImageInternal($image)){
					$this->Session->setFlash('Images saved');
				} else {
					$this->Session->setFlash('Image is not a valid jpeg files');
				}
			}
		}
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
		$this->redirect($this->referer());
	}
	
	/**
	 * Method is called from the add images form
	 * transforms the form input for internal procession
	 */
	public function uploadImages($contentId, $menue_context){
		
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
		if(count($this->params['form']['files']['size']) == 1 && $this->params['form']['files']['size'][0] == 0){
			$this->Session->setFlash('No file selected');
			$this->redirect($this->referer());
			return;
		}
		
		for($i = 0;$i<count($this->params['form']['files']['name']);$i++){
			$stringer = explode('.',$this->params['form']['files']['name'][$i]);

			if($this->strcontains($stringer[0],'.')){
			// not allowed
				$this->Session->setFlash('Corrupt Filename');
				break;
			} else {
			//check File Format
				if($stringer[1]!="jpeg" && $stringer[1]!="jpg" && $stringer[1]!="JPEG" && $stringer[1]!="JPG"){
				
					$this->Session->setFlash('Corrupt Filetype only JPG allowed');
					break;
				} else {
					$image = array('name' => $this->params['form']['files']['name'][$i],
							'tmp_name' => $this->params['form']['files']['tmp_name'][$i],
							'size' => $this->params['form']['files']['size'][$i],
							'title' => $this->params['form']['files']['name'][$i]
					);
			
				if($this->addImageInternal($image)){
					$this->Session->setFlash('Images saved');
				} else {
					$this->Session->setFlash('Image is not a valid jpeg files');
					break;
				}
				
			}//filetype
			}//filename
			
		}
		
		
		
		$this->redirect($this->referer());
		
	}
	
	/**
	 * Create View
	 * @param int $contentId
	 * @param String $menue_context
	 */
	public function create($contentId, $menue_context){
		
		$pluginId = $this->getPluginId();
		$createAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'create', true);
		
		
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
	}
	
	/**
	 * processes a new uploaded umade
	 * Structure:
	 * Image:
	 * 	[name]
	 * 	[tmp_name]
	 * 	[size]
	 * 	[title]
	 * @param unknown_type $image
	 */
	private function addImageInternal($image){
		
		$timestamp = time();
		$day = date("dmY",$timestamp);
		$time = date("Hi",$timestamp);

		$dir_gallery = "uploads/gallery";
		
		$filedest = "uploads/gallery".'/'.$day.$time.$image['name'];
		
		//if the folder does not exist create it!
		if(!file_exists($dir_gallery)){
			mkdir($dir_gallery);
		}
		
		if(!$image_source = @imagecreatefromjpeg($image['tmp_name'])){
			return false;
		}
		
		// Output
		imagejpeg($image_source,$filedest, 100);
		
		// save to db
		$dbImage = array(
					'title' => $image['title'],
					'path_to_pic' => $filedest );
		
		$this->GalleryPictureComp->generateThumbnail($dbImage);
		$this->GalleryPictureComp->save($this,$dbImage);
		return true;
	}
	
	/**
	 * Deletes one picture
	 * @param int $pictureId
	 * @param int $contentId
	 * @param string $menue_context
	 */
	public function delete($pictureId, $contentId, $menue_context){
		
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		if(!$this->deletePictureInternal($pictureId)){
			$this->redirect($this->referer());
		}
		
		$this->Session->setFlash('Image deleted');
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
		$this->redirect($this->referer());
	}
	
	/**
	 * Delete a list of images
	 * @param int $contentId
	 * @param string $menue_context
	 */
	public function deleteSelected($contentId,  $menue_context){
		$pluginId = $this->getPluginId();
		$deleteAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'delete', true);
		
		
		foreach($this->data['selectPictures'] as $imageId => $toBeDeleted){
			if($toBeDeleted == 1){
				if(!$this->deletePictureInternal($imageId)){
					$this->redirect($this->referer());
				}
			}
		}
		$this->Session->setFlash('Images deleted');
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
		$this->redirect($this->referer());
	}
	
	/**
	 * Deletes a picture
	 * @param int $pictureID
	 */
	private function deletePictureInternal($pictureID){
		
		// test if is title picture
		$this->loadModel('Gallery.GalleryEntry');
		$result = $this->GalleryEntry->query("SELECT * FROM gallery_entries WHERE gallery_picture_id = $pictureID");
		
		if(!empty($result)){
			$this->Session->setFlash('Could not delete the image: it is a title picture!');
			return false;
		}
		
		$picture = $this->GalleryPictureComp->delete($this,$pictureID);
		return true;
	}

	/**
	 * Method relating the Edit view to edit a gallery
	 * @param unknown_type $pictureId
	 * @param unknown_type $contentId
	 * @param unknown_type $menue_context
	 */
	public function edit($pictureId,$contentId,$menue_context){
		
		$pluginId = $this->getPluginId();
		$editAllowed = $this->PermissionValidation->actionAllowed($pluginId, 'edit', true);
		
		
		$picture = $this->GalleryPictureComp->getPicture($this,$pictureId);
		
		$data = array(	'Picture' => $picture);
		
		$this->set('data',$data);
		$this->set('ContentId',$contentId);
		$this->set('mContext',$menue_context);		
	}
	
	/**
	 * saves an image to the db
	 * @param unknown_type $contentId
	 * @param unknown_type $menue_context
	 */
	public function save($contentId, $menue_context){
		$this->GalleryPictureComp->save($this,$this->data['GalleryPicture']);
		$this->set('mContext',$menue_context);
		$this->set('ContentId',$contentId);
		$this->redirect(array('action' => 'index', $contentId,$menue_context));
	}
	
}