<?php 
/*
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
* @author Philipp Scholl
*
* @description View element to display the detail view of a certain news entry
*/

	App::uses('Sanitize', 'Utility');
	$data = Sanitize::clean($data, array('unicode' => true, 'encode' => false, 'remove_html' => true));;
	
	//bind javascript and css
	$this->Html->script('/newsblog/js/displayFullNews', false);
	$this->Html->css('/newsblog/css/displayFullNews', null, array('inline' => false));
	//load helpers
	$DateTimeHelper = $this->Helpers->load('Time');
	$this->Helpers->load('BBCode');
	$this->Helpers->load('SocialNetwork');
	
	//set meta tags for social network buttons
	//Facebook
	echo $this->Html->meta(null, null, array('property' => 'og:title', 'content' => $data['NewsEntry']['title'], 'inline' => false));
	echo $this->Html->meta(null, null, array('property' => 'og:description', 'content' => substr($this->BBCode->removeBBCode($data['NewsEntry']['text']), 0, 100), 'inline' => false));
	echo $this->Html->meta(null, null, array('property' => 'og:site_name', 'content' => env('SERVER_NAME'), 'inline' => false));
	//Google Plus
	echo $this->Html->meta(null, null, array('itemprop' => 'description', 'content' => substr($this->BBCode->removeBBCode($data['NewsEntry']['text']), 0, 100), 'inline' => false));
	echo $this->Html->meta(null, null, array('itemprop' => 'name', 'content' => $data['NewsEntry']['title'], 'inline' => false));
	
	//set title
	$this->set('title_for_layout', $data['NewsEntry']['title']);
?>

<div class='showFullNewsContainer'>
	<h2 class='showFullNewsTitle'>
		<?php echo $data['NewsEntry']['title'];?>
	</h2>
	<?php if($data['NewsEntry']['subtitle'] != null & $data['NewsEntry']['subtitle'] != ''){
		echo '<h3 class="showFullNewsSubtitle">'.$data['NewsEntry']['subtitle'].'</h3>';
	}?>
	<div class='showFullNewsInfo'>
		<?php 
		//split created on into two variables (1 for date, 1 for time)
		$createdOnDate = $DateTimeHelper->format('m-d-Y', $data['NewsEntry']['createdOn']);
		$createdOnTime = $DateTimeHelper->format('H:i', $data['NewsEntry']['createdOn']);
		//get information string from i18n and replace placeholders 
		$infoString = __d('newsblog', 'infostring');
		$infoString = str_replace(':-date-:', $createdOnDate, $infoString);
		$infoString = str_replace(':-time-:', $createdOnTime, $infoString);
		$infoString = str_replace(':-author-:', $data['Author'], $infoString);
		
		$modifiedString = __d('newsblog', 'modifiedstring');
		if($data['NewsEntry']['lastModifiedOn'] != null){
			$modifiedOnDate = $DateTimeHelper->format('m-d-Y', $data['NewsEntry']['lastModifiedOn']);
			$modifiedOnTime = $DateTimeHelper->format('H:i', $data['NewsEntry']['lastModifiedOn']);
			$modifiedString = str_replace(':-date-:', $modifiedOnDate, $modifiedString);
			$modifiedString = str_replace(':-time-:', $modifiedOnTime, $modifiedString);
		}
		//if entry is modified -> append modifiedString to infoString
		if(isset($modifiedOnDate) & isset($modifiedOnTime)){
			echo $infoString."&nbsp;&nbsp;(".$modifiedString.")";
		} else{
			echo $infoString;
		}
		?>
	</div>
	<div class='showFullNewsBody'>
		<?php echo $this->BBCode->transformBBCode($data['NewsEntry']['text']);?>
	</div>
	<div class='showFullNewsSocial'>
		<?php
			//Facebook
			echo $this->SocialNetwork->insertFacebookShare();
			//Google+
			echo $this->SocialNetwork->insertGoogleShare();
			//Twitter
			echo $this->SocialNetwork->insertTwitterShare();
		?>
	</div>
	<div class='showFullNewsOptions'>
	
	</div>
</div>