<?php 
	$this->Html->script('/newsblog/js/displayFullNews', false);
	$this->Html->css('/newsblog/css/displayFullNews', null, array('inline' => false));
	$DateTimeHelper = $this->Helpers->load('Time');
	$this->Helpers->load('BBCode');
	
	$this->set('title_for_layout', $data['NewsEntry']['title']);
?>

<div class='showFullNewsContainer'>
	<div class='showFullNewsTitle'>
		<?php echo $data['NewsEntry']['title'];?>
	</div>
	<div class='showFullNewsInfo'>
		<?php 
			$createdOnDate = $DateTimeHelper->format('m-d-Y', $data['NewsEntry']['createdOn']);
			$createdOnTime = $DateTimeHelper->format('H:i', $data['NewsEntry']['createdOn']);
			if($data['NewsEntry']['lastModifiedOn'] != null){
				$modifiedOnDate = $DateTimeHelper->format('m-d-Y', $data['NewsEntry']['lastModifiedOn']);
				$modifiedOnTime = $DateTimeHelper->format('H:i', $data['NewsEntry']['lastModifiedOn']);
			}
			
			$createdBy = $data['Author'];
		?>
		<?php echo $createdBy;?>
		on
		<?php echo $createdOnDate;?>
		at
		<?php echo $createdOnTime;
			
			if(isset($modifiedOnDate) & isset($modifiedOnTime)){
				echo "&nbsp;&nbsp;(modified on ".$modifiedOnDate." at ".$modifiedOnTime.")";
			}
		?>
	</div>
	<div class='showFullNewsBody'>
		<?php echo $this->BBCode->transformBBCode($data['NewsEntry']['text']);?>
	</div>
	<div class='showFullNewsSocial'>
	
	</div>
	<div class='showFullNewsOptions'>
	
	</div>
</div>