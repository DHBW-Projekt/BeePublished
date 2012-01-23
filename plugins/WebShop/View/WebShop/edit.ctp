<!-- Create new products for the catalog -->
<?php
	//LOAD menu
	echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<?php 
	//LOAD js
	$this->Html->script('ckeditor/ckeditor',false);
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/web_shop/js/admin',false);
	
	//LOAD style-sheet
	echo $this->Html->css('/WebShop/css/webshop');
	
	//DIV
	echo '<div id="webshop_create">';
	
	//TITLE
	echo '<h2>'.__d("web_shop", 'Edit Product').'</h2>';

	//PRINT error/success messages
	$validationErrors = $this->Session->read('Validation.WebshopProduct.validationErrors');
	echo $this->Session->flash('WebshopProduct');
	
	echo $this->Form->create('WebshopProduct', array('enctype' => 'multipart/form-data', 'url' => array('controller' => 'WebShop', 'action' => 'edit', $contentID, $this->data['WebshopProduct']['id'])));
	echo $this->Form->input('name', array('label' => (__d("web_shop", 'Name').':')));
	echo $this->Form->input('description', array('rows' => '4')); 
	echo $this->Form->input('price', array('label' => (__d("web_shop", 'Price').':')));
	echo $this->Form->label(__d("web_shop", 'Picture').':');
	echo $this->Form->file('WebshopProduct.submittedfile');
	echo "<br>";
	echo $this->Html->image('/WebShop/img/products/'.$this->data['WebshopProduct']['picture'], array('style' => 'width: 100px'));
	echo "<br>";
	echo $this->Form->submit(__d("web_shop", 'Save', true), array('name' => 'save', 'div' => false));
	echo $this->Form->submit(__d("web_shop", 'Cancel', true), array('name' => 'cancel', 'div' => false));
	echo $this->Form->end();
	
	echo "</div>";
