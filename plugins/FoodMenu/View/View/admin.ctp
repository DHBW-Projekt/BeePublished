<?php
	echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
	echo $this->Html->script('/food_menu/js/foodmenu', true); 
	echo $this->Html->script('/food_menu/js/jquery.cookie', true);
	echo $this->Html->script('/js/jquery-1.6.2.min.js', true); 
	echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
    echo $this->Html->scriptBlock('$(function() {$( "#tabs" ).tabs();});',array('inline' => true));
    echo $this->Html->scriptBlock('function showDiv(idOn,idOff){
 								    if(document.getElementById(idOn).style.display=="none") {
 								      document.getElementById(idOff).style.display="none";
 								      document.getElementById(idOn).style.display="block";
  								    }
 								    else {
  									  document.getElementById(idOn).style.display="none";
  									  document.getElementById(idOff).style.display="block";
  									  }
 								   }');
 	//echo $this->Html->scriptBlock('$( ".selector" ).tabs({ cookie: { expires: 7 } });');
?>

<div class="content">

<div id="tabs">

<ul>
<li><a href="#tabs-1"><?php echo (__('Speisepläne')); ?></a></li>
<li><a href="#tabs-2"><?php echo (__('Kategorien')); ?></a></li>
<li><a href="#tabs-3"><?php echo (__('Einträge')); ?></a></li>
</ul>
<div id="tabs-1" style="height:80%;">
<?php if(!(isset($mode))) $mode = ''; ?>
<p><?php echo $this->element('AdminMenus', array('menus' => $menus, 'mode' => $mode)); ?></p>
</div>
<div id="tabs-2">
<p><?php echo $this->element('AdminCategories', $categories); ?></p>
</div>
<div id="tabs-3">
<p><?php echo $this->element('AdminEntries', $entries); ?></p>
</div>
</div>
</div>
