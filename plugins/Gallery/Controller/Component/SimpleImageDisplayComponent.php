<?php
class SimpleImageDisplayComponent extends Component{
	
	public function getData($controller, $params, $url, $id){	
		$controller->loadModel("GalleryPicture");
		$pic = $controller->GalleryPicture->findById($params['pictureID']);
		
    	$data = array( 'params' => $params, 'url' => $url, 'id' => $id, 'picture' => $pic);
        return $data;
    }
}