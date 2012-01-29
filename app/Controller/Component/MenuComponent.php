<?php
class MenuComponent extends Component
{	
	var $components = array('PermissionValidation');
	
    function buildMenu($controller,$parent_id = null) {
    	$userRoleID = $this->PermissionValidation->getUserRoleId();
    	$entries = $controller->MenuEntry->find('all', array(
        	'conditions' => array(
    				'MenuEntry.parent_id' => $parent_id,
        			'MenuEntry.role_id <=' => $userRoleID
        	),
    		'order' => array('MenuEntry.order ASC'),
    	));
        $output = array();
        foreach($entries as $entry) {
            $page = $entry['Page'];
            $entry = $entry['MenuEntry'];
            $entry['Children'] = $this->buildMenu($controller,$entry['id']);
            $entry['Page'] = $page;
            $output[] = $entry;
        }
        return $output;
    }
}
