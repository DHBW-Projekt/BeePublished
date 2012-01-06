<!-- Creates short text based on long text -->
<?php
	//Attributes
	$word_limit = 30;
	$short_text = '';
	
	//COUNT text
	$words = split(' ', $text);
	$text_count = count($words);
	
	/*CREATE short text*/
	if ($text_count <= $word_limit){
		echo '<p>'.$text.'</p>';
	}else{
	
		for($i = 0; $i < $word_limit; $i++){
			$short_text = $short_text.$words[$i].' ';
		}
		
		echo '<p>'.$short_text.'... ';
		echo $this->Html->link('mehr',  '/webshop/view/'.$productID);
		echo '</p>';
	}
