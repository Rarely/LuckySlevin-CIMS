<div id="ideacontainer">
	<div class="idea-list-innerwrap">
		<?php foreach ($ideas as &$idea): ?>
			<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
		<?php endforeach; ?>
	</div>
</div>