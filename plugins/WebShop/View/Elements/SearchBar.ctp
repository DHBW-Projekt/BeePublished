<!-- Web-Shop Searchbar -->
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