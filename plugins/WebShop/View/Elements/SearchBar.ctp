<!-- Web-Shop Searchbar -->
<div id="websop_searchbar">   
    <?php    	    
    	//CREATE search-fields
    	echo '<div class="webshop_searchfield">';
		    echo $this->Form->create('Search', array('url' => '/webshop/search'));
		    echo $this->Form->input('Suche', array('div' => false));
		    echo $this->Form->submit('Los', array('div' => false,));
		    echo $this->Form->end();
	    echo '</div>';
		
	    //CREATE shopping cart
	    echo '<div id="webshop_cart" style="float:right">';
	    echo $this->Html->link(
	    	 $this->Html->image('/WebShop/img/Cart-32.png'),
	    	 '/webshop/cart', 
	    	 array('escape' => False)
	    );
   		echo '</div>';
   		
   		echo '<div style="clear:both"></div>';
    ?>
</div>