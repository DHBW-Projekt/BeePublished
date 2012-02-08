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
 * @description Web-Shop Searchbar.
 */
?>
<div id="websop_searchbar" class="color1">   
    <?php    	   
    	//CREATE search-fields
    	echo '<div class="webshop_searchfield">';
		    echo $this->Form->create('Search', array('url' => $url.'/webshop/search'));
		    echo $this->Form->input('SearchInput', array('div' => false, 'label' => (__d("web_shop", 'Search').':'), 'style' => 'width: 275px'));
		    echo $this->Form->submit(__d("web_shop", 'Go'), array('div' => false,));
		    echo $this->Form->end();
	    echo '</div>';
		
	    //CREATE shopping cart
	    echo '<div class="webshop_cartfield">';
	    echo $this->Html->link(
	    	 $this->Html->image('/WebShop/img/Cart-32.png'),
	    	 $url.'/webshop/cart', 
	    	 array('escape' => False)
	    );
   		echo '</div>';
   		
   		echo '<div style="clear:both"></div>';
    ?>
</div>