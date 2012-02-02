<?php
/*
 * This file is part of BeePublished which is based on CakePHP.
 * BeePublished is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or any later version.
 * BeePublished is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public
 * License along with BeePublished. If not, see
 * http://www.gnu.org/licenses/.
 *
 * @copyright 2012 Duale Hochschule Baden-Wuerttemberg Mannheim
 * @author Maximilian Stueber and Patrick Zamzow
 *
 * @description Creates short text based on long text.
 */

	//Attributes
	$word_limit = 18;
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
		echo $this->Html->link('mehr',  $url.'/webshop/view/'.$productID);
		echo '</p>';
	}
