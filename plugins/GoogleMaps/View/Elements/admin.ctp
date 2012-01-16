<h1>Address Book <?php 
echo $this->Html->link(
$this->Html->image("add2.png", array('width' => '32px')),
array('action' => 'create', $contentID),
array('escape' => False)
);
?></h1>

<table id="address_table">
	<tr>
		<th></th>
		<th>Street</th>
		<th>Street Number</th>
		<th>ZIP Code</th>
		<th>City</th>
		<th>Country</th>
		<th></th>
	</tr>
	<?php foreach ($locations as $location): ?>
	<tr>
		<td><?php 
		echo $this->Html->link(
		$this->Html->image("check.png", array('width' => '32px')),
		array('action' => 'setLocation', $contentID, $location['GoogleMapsLocation']['id']),
		array('escape' => False)
		);
		?></td>
		<td><?php if ($currentLocation == $location) {echo "<b>"; }?> <?php echo $location['GoogleMapsLocation']['street']; ?>
		<?php if ($currentLocation == $location) {echo "</b>"; }?></td>
		<td><?php if ($currentLocation == $location) {echo "<b>"; }?> <?php echo $location['GoogleMapsLocation']['street_number']; ?>
		<?php if ($currentLocation == $location) {echo "</b>"; }?></td>
		<td><?php if ($currentLocation == $location) {echo "<b>"; }?> <?php echo $location['GoogleMapsLocation']['zip_code']; ?>
		<?php if ($currentLocation == $location) {echo "</b>"; }?></td>
		<td><?php if ($currentLocation == $location) {echo "<b>"; }?> <?php echo $location['GoogleMapsLocation']['city']; ?>
		<?php if ($currentLocation == $location) {echo "</b>"; }?></td>
		<td><?php if ($currentLocation == $location) {echo "<b>"; }?> <?php echo $location['GoogleMapsLocation']['country']; ?>
		<?php if ($currentLocation == $location) {echo "</b>"; }?></td>
		<td><?php 
		echo $this->Html->link(
		$this->Html->image("remove.png", array('width' => '32px')),
		array('action' => 'remove', $contentID, $location['GoogleMapsLocation']['id']),
		array('escape' => False)
		);
		?></td>
	</tr>
	<?php endforeach; ?>
</table>
