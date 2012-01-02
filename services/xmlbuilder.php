<?php


function getRC0Xml(){

	$header = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>\n";
	$content = "<RC>0</RC>";
	$xml = $header.$content;
	return utf8_decode($xml);
}

function getRC1Xml(){
	$header = "<?xml version=\"1.0\" encoding=\"UTF-8\" ?>";
	$content = "<RC>1</RC>";
	$xml = $header.$content;
	return $xml;
}

?>