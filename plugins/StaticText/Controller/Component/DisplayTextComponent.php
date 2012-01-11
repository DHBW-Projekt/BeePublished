<?php

class DisplayTextComponent extends Component
{
	//Shows the text from the contentvalue-model
    public function getData($controller,$params)
    {  
       	if (!array_key_exists('Text',$params)) {
               return __('no text');
        } else {
            return $params['Text'];
        }
        
    }
}
