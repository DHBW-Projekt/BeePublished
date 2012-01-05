
<?php
	echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
	echo $this->Html->script('/js/jquery-1.6.2.min.js', true);
	echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
    echo $this->Html->scriptBlock('$(function() {$( "#tabs" ).tabs();});',array('inline' => true));
?>



<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Newsletter</a></li>
		<li><a href="#tabs-2">Recipients</a></li>
		<li><a href="#tabs-3">Templates</a></li>
	</ul>
	<div id="tabs-1">
		<p></p>
	</div>
	<div id="tabs-2">
		<p></p>
	</div>
	<div id="tabs-3">
		<p></p>
	</div>
</div>



