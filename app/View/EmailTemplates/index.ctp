<?php
/**
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
 * @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
 * @author Tobias Höhmann
 * 
 * @description email template index view
 */ 
	echo $this->element('config-menu');
	
	$this->Html->script('ckeditor/ckeditor', false);;
	$this->Html->script('ckeditor/adapters/jquery',false);
	$this->Html->script('/js/admin/emailtemplate',false);
?>	
<div>
	<?php
		// create form for showing the currently selected template and
		echo $this->Form->create('EmailTemplate', array(
			'url' => array('controller' => 'EmailTemplates', 'action' => 'getAction')));
		echo '<div>';
		echo $this->Form->input('id', array(
			'value' => $selectedTemplate['EmailTemplate']['id'],
			'onChange' => 'document.forms[\'EmailTemplateIndexForm\'].submit();',
			'options' => $names,
			'label' => __('Template'),
			'div' => false));
		// define button for adding the edit button
		echo $this->Form->submit('/img/edit.png', array(
			'name' => 'EditTemplate', 
			'div' => false));
		// define button for adding the delete button
		echo $this->Form->submit('/img/delete.png', array(
			'name' => 'DeleteTemplate', 
			'div' => false,
			'onclick' => 'return confirm("Do you really want to delete the template?");'));
		echo '</div>';
		echo $this->Form->submit(__('Create new template'), array(
			'name' => 'CreateTemplate', 
			'div' => false));
		echo $this->Form->end();
	?>	
</div>
<br>
<hr>
<br>
<div>
	<h1>
		<?php echo __('Active Template: ').$selectedTemplate['EmailTemplate']['name'] ?>
	</h1>
	<?php
		// show active template preview here
		echo $this->Form->textarea('EmailTemplates.Preview', array(
					'label' => '', 
					'value' => $selectedTemplate['EmailTemplate']['content'],
					'rows' => '30'));
	?>
</div>