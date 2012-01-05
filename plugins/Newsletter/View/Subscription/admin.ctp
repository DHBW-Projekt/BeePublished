
<?php
	echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
	echo $this->Html->script('/newsletter/js/newsletter', true);
	echo $this->Html->script('/js/jquery-1.6.2.min.js', true);
	echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
    echo $this->Html->scriptBlock('$(function() {$( "#tabs" ).tabs();});',array('inline' => true));
?>



<div id="tabs">
	<ul>
		<li><a href="#tabs-1">General settings</a></li>

	</ul>
	<div id="tabs-1">
		<p></p>
	</div>

</div>

