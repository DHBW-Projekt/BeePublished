<?php

class DisplayTextComponent extends Component
{
		
    public function getData($controller,$params)
    {  
       	if (!array_key_exists('Text',$params)) {
               return __('no text');
        } else {
            return $params['Text'];
        }
        
    }
}
