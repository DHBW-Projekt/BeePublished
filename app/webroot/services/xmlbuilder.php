<?php
function getRC0Xml(){
	$content = "<RC>0</RC> \n\r";
	return $content;
}

function getRC1Xml(){
	$content = "<RC>1</RC> \n\r ";
	return $content;
}

function getAnswer($answer_content){
	$header = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?> \n\r ";
	$start = "<ServiceAnswer>";
	$end ="</ServiceAnswer>";
	$xml = $header.$start.$answer_content.$end;
	return $xml;
}

function getbackupServiceAnswer($sqldump_url, $zip_url){
	$sql = "<SqlUrl>".$sqldump_url."</SqlUrl>  \n\r";
	$zip = "<ZipUrl>".$zip_url."</ZipUrl>   \n\r";
	return $sql.$zip;
}
?>