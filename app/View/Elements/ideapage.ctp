<?php echo $this->Html->css('style.css');?>
<div  id="ideacontainer" class="ideacontainer2">
	<div id="Grid">
		<?php foreach ($ideas as &$idea): ?>
			<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
		<?php endforeach; ?>
	</div>
</div>