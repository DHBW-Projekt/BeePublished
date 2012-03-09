<?php
/**
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
 * @author Tobias Höhmann
 * 
 * @description This controller includes the logic for creating, editing, saving and deleting email templates.
 */

App::uses('AppController', 'Controller');

class EmailTemplatesController extends AppController
{
	
    function beforeFilter()
    {
        parent::beforeFilter();
        $this->PermissionValidation->actionAllowed(null, 'EmailTemplate', true);
    }

/**
 * 
 * function for the index page
 * 
 */
    function index($templateId = Null) {
        $this->layout = 'overlay';
		
        $this->createInitialTemplate();
        
        // retrieve the selected template from database
        if(isset($templateId)) {
    		$selectedTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => $templateId)));
    	} else {
			$selectedTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.active' => '1')));    		
    	}  	

        $emailTemplateNames = $this->EmailTemplate->find('list', array('fields' => array('EmailTemplate.name')));
        
        // set variables for the plugin view
        $this->set('names', $emailTemplateNames);
        $this->set('selectedTemplate', $selectedTemplate);
    }

/**
 * 
 * function for creating and adding the initial template
 * 
 */
    function createInitialTemplate() {
    	// define the standard layout 
    	$standardLayout = '
	<div style="font-family: Arial,Tahoma,sans-serif;
		font-size:14px;
	    color: #fff;background-image: url(\'http://'.env('SERVER_NAME').'/theme/Christoph2/img/bg.jpg\');
	    padding:70px 20px 20px 20px;">
	<div style="height: 30px;
	    left: 0;
	    line-height: 30px;
	    position: fixed;
	    text-align: right;
	    top: 0;
	    width: 100%;
	    z-index: 998;background-color: #2E2E2E;
	    font-size: 11px;"> Headertext </div>
	<div style="   background-color: #F4F4F4;
	    color: #000000;
	    display: block;   
	    padding: 10px 0;"> EMAILTEXTCONTENT </div>
	<div style=" bottom: 0;
	    height: 30px;
	    left: 0;
	    line-height: 30px;
	    position: fixed;
	    width: 100%;
	    z-index: 998;background-color: #2E2E2E;
	    font-size: 11px;">'.__('Powered by BeePublished - All rights reserved - &copy; Copyright 2011-2012').'</div>
	</div>';
    	// save the standard layout 
    	$selectedTemplate = $this->EmailTemplate->find('first');
    	if(empty($selectedTemplate)) {
    		$this->EmailTemplate->set('content', $standardLayout);
    		$this->EmailTemplate->set('name', 'BeeEmailTemplate');
    		$this->EmailTemplate->set('active', 1);
    		$this->EmailTemplate->save();
    	}
    }

/**
 * 
 * function for retrieving the information which button was clicked and executes a redirect
 * 
 */    
    function getAction() {
    	// get the action and execute a redirect
        if(isset($this->params['data']['CreateTemplate'])) {
        	$this->redirect('/emailtemplates/create/');
        }
        if(isset($this->params['data']['EditTemplate_x'])) {    		
			$this->redirect('/emailtemplates/edit/'.$this->request->data['EmailTemplate']['id']);
    	}
        if(isset($this->params['data']['DeleteTemplate_x'])) {
        	$this->redirect('/emailtemplates/delete/'.$this->request->data['EmailTemplate']['id']);
        }
        if(isset($this->params['data']['EmailTemplate']['id'])) {
        	$this->redirect('/emailtemplates/activate/'.$this->request->data['EmailTemplate']['id']);
        }
        // redirect to the referer (probably index page)
        $this->redirect($this->referer());
    }

/**
 * 
 * function for the create email template view
 * 
 */    
    function create() {
   		$this->layout = 'overlay';
    }

/**
 * 
 * function for the edit email template view
 * 
 */
    function edit($templateId) {
    	$this->layout = 'overlay';
    	// find the selected template
    	$selectedTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => $templateId)));
    	// set the selected template into a view variable
    	$this->set('selectedTemplate', $selectedTemplate);
    }

/**
 * 
 * function for save email template view
 * 
 */
    function save($templateId) {
    	$this->EmailTemplate->set($this->request->data);
    	// save the template on template id
    	if(isset($templateId) && $templateId != 'NEW') {
    		$this->EmailTemplate->set('id',$templateId);
    	}
    	// check the content and return if noch "EMAILTEXTCONTENT" is included
    	if(!($this->checkContent($this->request->data['EmailTemplate']['content']))) {
    		$this->Session->setFlash(__('Saving failed. You have to include the text "EMAILTEXTCONTENT" once.'), 'default', array('class' => 'flash_failure'));
    		$this->redirect($this->referer());
    	} else {
    		// prepare the content by replacing relative urls with absolute urls
    		$content = $this->prepareContent($this->request->data['EmailTemplate']['content']);
    		$this->EmailTemplate->set('content',$content);
	    	if ($this->EmailTemplate->save()) {
	        	$this->Session->setFlash(__('Successfully saved'));
	        } else {
	            $this->Session->setFlash(__('Saving failed'), 'default', array('class' => 'flash_failure'));
			}
			if(isset($templateId)) {
				$this->redirect($this->referer());			
			} else {
				$this->redirect('/emailtemplates/index/');
			}    		
    	}   	
    }

/**
 * 
 * function for changing the links in the email template
 * 
 */  
	function prepareContent($checkString) {
    	$pattern = "/src=\"\/uploads\//";
		$replacement = "src=\"http://".env('SERVER_NAME')."/uploads/";
		// replace all src="/uploads/..." links with full server links for emails 
		$string = preg_replace($pattern, $replacement, $checkString);
		return $string;
    }

/**
 * 
 * function for checking the content of the email template
 * 
 */    	
    function checkContent($checkString) {
		$pattern = "/EMAILTEXTCONTENT/";
		// search for the "EMAILTEXTCONTENT" string in order to define the injection point for every emails content
		if(preg_match($pattern, $checkString) != 0) {
			return true;
		}
		return false;
    }

/**
 * 
 * function for deleting an email template
 * 
 */    
    function delete($templateId) {
    	$selectedTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => $templateId)));
    	// Removes the Email Template and sets the message for successful deletion
    	if ($this->EmailTemplate->delete($templateId)) {
    		$this->Session->setFlash(__('Successfully deleted'));
    		$newActiveTemplate = $this->EmailTemplate->find('first');
    		// sets a new active template after the successful deletion of the current active template
    		if(!(empty($newActiveTemplate))) {
				$newActiveTemplate['EmailTemplate']['active'] = '1';
    			$this->EmailTemplate->save($newActiveTemplate);
    		} else {
    			$this->createInitialTemplate();
    		}
        } else {
            $this->Session->setFlash(__('Deletion failed'), 'default', array('class' => 'flash_failure'));
		}
		$this->redirect($this->referer());
    }

/**
 * 
 * function for activating an email template
 * 
 */    
    function activate($templateId) {
        // get the data for the selected template
    	$selectedTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.active' => '1')));
        $selectedTemplate['EmailTemplate']['active'] = '0';        	
        $newTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => $templateId)));
        $newTemplate['EmailTemplate']['active'] = '1';
        // activate the template, save to database and set success flash messages
		if ($this->EmailTemplate->save($newTemplate)) {
			$this->Session->setFlash(__('Successfully saved'));
        		if($newTemplate['EmailTemplate']['id'] != $selectedTemplate['EmailTemplate']['id']) {
					$this->EmailTemplate->save($selectedTemplate);                	
        		}
        } else {
        	$this->Session->setFlash(__('Saving failed'), 'default', array('class' => 'flash_failure'));
        }
        $this->redirect($this->referer('/emailtemplates/index/'));
    }
}
