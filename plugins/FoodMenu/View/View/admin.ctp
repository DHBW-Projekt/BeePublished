<?php
	echo $this->Html->css('/css/jquery-ui/jquery-ui-1.8.16.custom');
	echo $this->Html->css('food_menu/css/menu');
	echo $this->Html->script('/food_menu/js/foodmenu', true); 
	echo $this->Html->script('/food_menu/js/jquery.cookie', true);
	echo $this->Html->script('/js/jquery-1.6.2.min.js', true); 
	echo $this->Html->script('/js/jquery-ui-1.8.16.custom.min.js', true);
    //echo $this->Html->scriptBlock('$(function() {$( "#tabs" ).tabs();});',array('inline' => true));
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
// 	echo $this->Html->scriptBlock('$( ".selector" ).tabs({ cookie: { expires: 1 } });');
?>
<?php
	echo $this->element('PluginMenu');
?>
<div class="content">

<?php
//		debug($mode);
//		if(!(isset($mode)) || $mode = '') {$mode = 'overview';}
//		switch($mode){
//			case 'edit':
//				echo "blub";
//				$showDiv = array('overview' => 'display:none;', 'create' => 'display:none;', 'edit' => 'display:block;');
//				break;
//			case 'create':
//				$showDiv = array('overview' => 'display:none;', 'create' => 'display:block;', 'edit' => 'display:none;');
//				break;
//			case 'overview':
//				$showDiv = array('overview' => 'display:block;', 'create' => 'display:none;', 'edit' => 'display:none;');
//				break;
//			}
//		debug($showDiv);
	?>
</div>
