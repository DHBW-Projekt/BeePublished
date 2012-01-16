<?php
class MenuComponent extends Component
{
	function buildMenu($controller,$parent_id = null) {
		$entries = $controller->MenuEntry->findAllByParentId($parent_id,array(),array('MenuEntry.order'=>'ASC'));
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
