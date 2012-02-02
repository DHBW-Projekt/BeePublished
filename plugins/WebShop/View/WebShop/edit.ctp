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
 * @description Edit product of the catalog.
 */

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
	echo $this->Form->hidden('picturePath');
	echo "<br>";
	echo $this->Html->image($this->data['WebshopProduct']['picturePath'].$this->data['WebshopProduct']['picture'], array('style' => 'width: 100px'));
	echo "<br>";
	echo $this->Form->submit(__d("web_shop", 'Save', true), array('name' => 'save', 'div' => false));
	echo $this->Form->submit(__d("web_shop", 'Cancel', true), array('name' => 'cancel', 'div' => false));
	echo $this->Form->end();
	
	echo "</div>";
