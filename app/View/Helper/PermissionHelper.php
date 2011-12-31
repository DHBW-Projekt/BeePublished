<?php
App::uses('AppHelper', 'View/Helper');

class PermissionHelper extends AppHelper {
	var $helpers = array('Session');
	
	public function getUserRoleId(){
		//get currently logged in user and his role
		$userRoleId = (int)$this->Session->read('Auth.User.id');
		return $userRoleId;
	}
	
	public function getPermissions($pluginId = null){
		//get currently logged in user and his role
		$userRoleId = (int)$this->Session->read('Auth.User.role_id');
		$allPermissionsOfPlugin = $this->Permission->find('all', array('conditions' => array('plugin_id' => $pluginId)));
		$allActions = array();
		foreach ($allPermissionsOfPlugin as $aPermission){
			$action = $aPermission['Permission']['action'];
			$actionAllowed = $this->internalActionAllowed($userRoleId, $aPermission);
			$allActions[$action] = $actionAllowed;
		}
		
		return $allActions;
	}
	
	public function actionAllowed($pluginId = null, $action = null){
		$this->Permission = ClassRegistry::init('Permission');
		$this->Role = ClassRegistry::init('Role');
		
		//get currently logged in user and his role
		$userRoleId = (int)$this->Session->read('Auth.User.role_id');
		//get required permission for given plugin and action
		$permissionQueryOptions = array('conditions' => array('plugin_id' => $pluginId, 'action' => $action));
		$permissionEntry = $this->Permission->find('first', $permissionQueryOptions);
		
		$actionAllowed = false;
		//read currentRoleId -- initial value equals minimum required role id
		$currentRoleId = (int)$permissionEntry['Permission']['role_id'];
		//read parentRole -- initial value equals minimum required role
		$parentRole = $this->Role->findById($currentRoleId);
		
		while (true) {
			if ($currentRoleId == $userRoleId){
				//user is allowed to perform the action
				$actionAllowed = true;
				break;
			} else{
				if($parentRole['Role']['parent_id'] != null){
					//get parent role and set currentRoleId
					$parentRole = $this->Role->findById($parentRole['Role']['parent_id']);
					$currentRoleId = (int)$parentRole['Role']['id'];
				} else{
					//there is no more parent role and user is not allowed to perform the action
					break;
				}
			}
		}
		return $actionAllowed;
	}
	
	private function internalActionAllowed($userRoleId = null, $permissionEntry = null){
		$actionAllowed = false;
		//read currentRoleId -- initial value equals minimum required role id
		$currentRoleId = (int)$permissionEntry['Permission']['role_id'];
		//read parentRole -- initial value equals minimum required role
		$parentRole = $this->Role->findById($currentRoleId);
		
		while (true) {
			if ($currentRoleId == $userRoleId){
				//user is allowed to perform the action
				$actionAllowed = true;
				break;
			} else{
				if($parentRole['Role']['parent_id'] != null){
					//get parent role and set currentRoleId
					$parentRole = $this->Role->findById($parentRole['Role']['parent_id']);
					$currentRoleId = (int)$parentRole['Role']['id'];
				} else{
					//there is no more parent role and user is not allowed to perform the action
					break;
				}
			}
		}
		return $actionAllowed;
	}
}
