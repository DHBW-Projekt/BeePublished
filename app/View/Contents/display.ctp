<?php
if (isset($error)) {
    echo 'Unknown module';
} else {
    echo $this->Html->link(
        $this->Html->image('tools.png', array('class' => 'setting_image')),
        array('plugin' => $plugin, 'controller' => $view, 'action' => 'admin', $id),
        array('escape' => False, 'id' => 'overlay', 'class' => 'setting_button')
    );
    echo $this->element(
    	$view, 
    	array(
    		'data' => $data,
    		'url' => $url, 
    		'contentId' => $id, 
    		'pluginId' => $pluginId
    	), 
    	array('plugin' => $plugin)
    );
}
?>