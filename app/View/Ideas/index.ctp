<h1>Ideas</h1>
    <?php foreach ($ideas as $idea): ?>
        <?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    <?php endforeach; ?>
    <?php unset($idea); ?>
	<?php echo $this->element('newideaform'); ?>