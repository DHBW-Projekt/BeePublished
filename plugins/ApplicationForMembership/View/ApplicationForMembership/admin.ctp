<!--  Application Adminstration View -->

<?php 
	//LOAD css-file
	$this->Html->css('/ApplicationForMembership/applcation_for_membership');
	
	//LOAD menue
	//echo $this->element('admin_menu', array('contentID' => $contentID));
?>

<div id="application_for_membership_admin">
	<h2>Offene MitgliedsantrŠge</h2>
	<?php 
		//data in attribute 'applications'
		pr($applications);
	?>
</div>