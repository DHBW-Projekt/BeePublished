<?php

class DisplayTextComponent extends Component
{
		
    public function getData($controller,$params)
    {  
       	if (!array_key_exists('Text',$params)) {
            return 'no text';
        } else {
            return $params['Text'];
        }
        
    }
    
    public function beforeFilter() {
    	parent::beforeFilter();
    
    	//Actions which don't require authorization
    	$this->Auth->allow('*');
    }
}
