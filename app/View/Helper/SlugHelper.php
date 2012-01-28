<?php
App::uses('AppHelper', 'View/Helper');

class SlugHelper extends AppHelper {

	public function generateSlug($slug = null){
		//$slug = iconv("utf-8", "ASCII//TRANSLIT", utf8_encode($string));
		//replace äÄ üÜ öÖ
		$slug = str_replace(array('ä','Ä'),'ae',$slug);
		$slug = str_replace(array('ö','Ö'),'oe',$slug);
		$slug = str_replace(array('ü','Ü'),'ue',$slug);
		//remove not compatible parts, remove spaces at begin and end of string, convert to lower case
		$slug = strtolower(trim(preg_replace('/[^\w\d_ -]/si', '', $slug)));
		//replace spaces with -
		$slug = str_replace(' ', '_', $slug);
		return $slug;
	}
}