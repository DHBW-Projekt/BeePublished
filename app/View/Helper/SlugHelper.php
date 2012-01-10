<?php
App::uses('AppHelper', 'View/Helper');

class SlugHelper extends AppHelper {

	public function generateSlug($string = null){
		$slug = iconv("utf-8", "ASCII//TRANSLIT", utf8_encode($string));
		//replace Š€ š… Ÿ†
		$slug = str_replace(array('"a','"A'),'ae',$slug);
		$slug = str_replace(array('"o','"O'),'oe',$slug);
		$slug = str_replace(array('"u','"U'),'ue',$slug);
		//remove not compatible parts, remove spaces at begin and end of string, convert to lower case
		$slug = strtolower(trim(preg_replace('/[^\w\d_ -]/si', '', $slug)));
		//replace spaces with -
		$slug = str_replace(' ', '-', $slug);
		return $slug;
	}
}