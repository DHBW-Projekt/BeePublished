<?php 
	$this->Html->css('/newsblog/css/editNews', null, array('inline' => false));
	$this->Html->script('/newsblog/js/editNews', false);
	$this->Html->script('/ckeditor/ckeditor', false);
	$this->Html->script('/ckeditor/adapters/jquery', false);
	
	//get configured date format
	//split valid from
	$validFrom = $newsentry['NewsEntry']['validFrom'];
	$validFromPieces = explode("-", $validFrom);
	$validFromYear = $validFromPieces[0];
	$validFromMonth = $validFromPieces[1];
	$validFromDay = $validFromPieces[2];
	//split valid to
	$validTo = $newsentry['NewsEntry']['validTo'];
	$validToPieces = explode("-", $validTo);
	$validToYear = $validToPieces[0];
	$validToMonth = $validToPieces[1];
	$validToDay = $validToPieces[2];
	
	$this->Js->set('newsentryid', $newsentry['NewsEntry']['id']);
	$this->Js->set('contentid', $newsentry['NewsEntry']['content_id']);
?>
<div class="nbEntryContainer">
	<div class="editNewsTitle">
		<input type="text" id="nbTitleTextfield" class="nbTitleTextfield" value="<?php echo $newsentry['NewsEntry']['title']?>">
	</div>
	<div class="editNewsBody">
		<textarea id="editNewsTextEditor" name="editNewsTextEditor"><?php echo $newsentry['NewsEntry']['text']?></textarea>
	</div>
	<div class="editValidConfiguration">
		valid from <input type="text" id="nbValidFromDatepicker" class="datepicker"> to <input type="text" id="nbValidToDatepicker" class="datepicker">
	</div>
	<div class="editNewsButtons">
		<div id="nbSaveChangesButton" class="button">Save Changes</div>
	</div>
</div>