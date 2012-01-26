<h2>
	<?php
		$this->Html->script('/impressum/js/impressum', false);
		echo __('Bitte geben Sie die Daten der zuständigen Aufsichtsbehörde an.');
	?>
</h2>
<br>
<?php
	echo $this->Form->create('Impressum',array('url' => array('plugin'     => 'Impressum',
														   	  'controller' => 'Show',
															  'action'	   => 'admOffice'))); 
?>
<br>
<div id = 'datadiv'>
	<?php
		echo $this->Form->label('Impressum.adm_office_name', __('Name der Behörde:'));
		if (!empty($data['Impressum']['adm_office_name'])) {
			echo $this->Form->input('Impressum.adm_office_name', array('label' => false, 'value' => $data['Impressum']['adm_office_name']));
		} else {
			echo $this->Form->input('Impressum.adm_office_name', array('label' => false));
		}
		
		echo $this->Form->label('Impressum.adm_office_street', __('Straße:'));
		if (!empty($data['Impressum']['adm_office_street'])) {
			echo $this->Form->input('Impressum.adm_office_street', array('label' => false, 'value' => $data['Impressum']['adm_office_street']));
		} else {
			echo $this->Form->input('Impressum.adm_office_street', array('label' => false));
		}
		
		echo $this->Form->label('Impressum.adm_office_house_no', __('Hausnummer:'));
		if (!empty($data['Impressum']['reg_house_no'])) {
			echo $this->Form->input('Impressum.adm_office_house_no', array('label' => false, 'value' => $data['Impressum']['adm_office_house_no']));
		} else {
			echo $this->Form->input('Impressum.adm_office_house_no', array('label' => false));
		}
		
		echo $this->Form->label('Impressum.adm_office_post_code', __('Postleitzahl:'));
		if (!empty($data['Impressum']['adm_office_post_code'])) {
			echo $this->Form->input('Impressum.adm_office_post_code', array('label' => false, 'value' => $data['Impressum']['adm_office_post_code']));
		} else {
			echo $this->Form->input('Impressum.adm_office_post_code', array('label' => false));
		}
		
		echo $this->Form->label('Impressum.adm_office_city', __('Ort:'));
		if (!empty($data['Impressum']['adm_office_city'])) {
			echo $this->Form->input('Impressum.adm_office_city', array('label' => false, 'value' => $data['Impressum']['adm_office_city']));
		} else {
			echo $this->Form->input('Impressum.adm_office_city', array('label' => false));
		}
		
		echo $this->Form->label('Impressum.adm_office_country', __('Land:'));
		if (!empty($data['Impressum']['adm_office_country'])) {
			echo $this->Form->input('Impressum.adm_office_country', array('label' => false, 'value' => $data['Impressum']['adm_office_country']));
		} else {
			echo $this->Form->input('Impressum.adm_office_country', array('label' => false));
		}
	?>
</div>
<br>
<?php echo $this->Form->end(__('Impressum erstellen')); ?>