<?php echo $this->Html->css('style.css');?>
<div class="smallideablock">
  	Name:  <?php echo $idea['Idea']['name']; ?><br>
  	Status: <?php echo $idea['Idea']['status']; ?> <br>
	Description:<br>
	<div id="descriptionblock">
	 	<?php echo $idea['Idea']['description']; ?>
	</div>
</div>