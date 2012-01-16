<h1>Dateien von Ihnen</h1>

<table>
	<tr>
		<th>Filename</th>
		<th>Size</th>
		<th>Options</th>
	</tr>

	<?
	foreach ($my_files as $file):
	?>
	<tr>
		<td><? echo $file['MyFile']['filename'] ?></td>
		<td><? echo $file['MyFile']['size'] ?></td>
		<td><? echo $this->Html->link('Delete',array('controller' => 'my_files', 'action' => 'delete', $file['MyFile']['ID'])); ?></td>
	</tr>
	<?
	endforeach;
	?>
</table>
