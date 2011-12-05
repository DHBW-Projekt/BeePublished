<?php

class FileFinderComponent extends Component {
	
	private $path = '../webroot/css';
	
	function findDesigns(){
		$allFiles = scandir($this->path);
		$allDesigns = $this->removeNonFiles($allFiles);
		//TODO Unterscheidung
		return $allDesigns;
	} //findDesigns
	
	function findTemplates(){
		$allFiles = scandir($this->path);
		$allTemplates = $this->removeNonFiles($allFiles);
		//TODO Unterscheidung
		return $allTemplates;
	} //findTemplates
	
	private function removeNonFiles($fileArray){
		$key = array_search('.', $fileArray);
		if (isset($key)){
			unset($fileArray[$key]); // verhindert Anzeige von "."
		}
		$key  = NULL;
		$key = array_search('..', $fileArray);
		if (isset($key)){
			unset($fileArray[$key]); // verhindert Anzeige von ".."
		}
		return $fileArray;
	} //removeNonFiles
	
} //class

//		// Possible additional information
// 			foreach ($allFiles as $file) {
// 				$fileInfo = pathinfo($path."/".$file);
// 				//The following variables are now avaliable
// 				// $dateiinfo['filename'] = filename without extension  *starting with PHP 5.2
// 				// $dateiinfo['dirname'] = directory name
// 				// $dateiinfo['extension'] = file extension
// 				// $dateiinfo['basename'] = filename including extension
// 				} //foreach