<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<?php
	echo $this->Html->css('jquery-ui-1.8.16.custom');
?>


<div class="demo">

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Newsletter</a></li>
		<li><a href="#tabs-2">Recipients</a></li>
		<li><a href="#tabs-3">Templates</a></li>
	</ul>
	<div id="tabs-1">
		<p>Newsletter</p>
		<table>
			<tr>
				<th>Date</th>
				<th>Title</th>
				<th>Details</th>
			</tr>
			<tr>
				<td>2011-01-16</td>
				<td>Newsletter 1/2011</td>
				<td><a href=""> Details </a></td>
			</tr>
		</table>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		
	</div>
	<div id="tabs-2">
		<p>Recipients</p>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	</div>
	<div id="tabs-3">
		<p>Templates</p>
	</div>
</div>

</div><!-- End demo -->



<div class="demo-description" style="display: none; ">
<p>Click tabs to swap between content that is broken into logical sections.</p>
</div><!-- End demo-description -->