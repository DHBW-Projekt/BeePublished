
<?php echo $this->Form->create('Configuration'); ?>
<?php echo $this->Form->input('lastName') ?> 
<?php echo $this->Form->input('firstName') ?>
<?php echo $this->Form->input('eMail') ?>
<?php echo $this->Form->input('street') ?>
<?php echo $this->Form->input('houseNumber') ?>
<?php echo $this->Form->input('postCode') ?>
<?php echo $this->Form->input('city') ?>
<?php echo $this->Form->input('phone') ?>
<?php echo $this->Form->input('fax') ?>
<?php echo $this->Form->input('companyName') ?>
<?php echo $this->Form->input('legalForm') ?>
<?php echo $this->Form->input('vatId') ?>
<?php echo $this->Form->input('registerNumber') ?>
<?php echo $this->Form->input('status') ?>
<?php echo $this->Form->select('activeDesign', $designs) ?>
<!-- In order to get the error message displayed -->
<?php echo $this->Form->error('Configuration.activeDesign'); ?>
<?php echo $this->Form->select('activeTemplate', $templates) ?>
<!-- In order to get the error message displayed -->
<?php echo $this->Form->error('Configuration.activeTemplate'); ?>
<?php echo $this->Form->end(__('Save Configuration')); ?>	
