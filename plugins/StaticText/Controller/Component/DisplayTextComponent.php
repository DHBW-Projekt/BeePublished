<?php

class DisplayTextComponent extends Component
{
	//Shows the text from the contentvalue-model
    public function getData($controller,$params)
    {  
       	if (!array_key_exists('Text',$params) || !array_key_exists('Published',$params)) {
               return __d('static_text', 'no text');
        } else {
	     	$pub = $params['Published'];
	     	// not published
	     	if (!$pub){
	     		return __(''); 
	     	}	
            return $params['Text']; //exists and published
        }
        
    }
}
