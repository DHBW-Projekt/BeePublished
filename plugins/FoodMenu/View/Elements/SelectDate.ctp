<div id="foodMenuHeader" style="width:100%; height:50px">
<?php echo $this->Form->create();?>
<?php echo $this->Form->button('today');?>
<?php echo $this->Form->button('tomorrow');?>
Date: <input id="datepicker" type="text" size="15"/>
<?php echo $this->Form->end();?>        

<?php echo $this->Ajax->datepicker('datepicker');?>          
</div>