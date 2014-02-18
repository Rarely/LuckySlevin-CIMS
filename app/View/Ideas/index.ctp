<h1>Ideas</h1>
<<<<<<< HEAD
<?php echo $this->element('newideaform'); ?>
<div id="ideacontainer">
=======
>>>>>>> 59c799590924c852049575cec6513f4c4c3b3282
    <?php foreach ($ideas as $idea): ?>
        <?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    <?php endforeach; ?>
    <?php unset($idea); ?>
<<<<<<< HEAD
</div>
	
=======
	<?php echo $this->element('newideaform'); ?>
>>>>>>> 59c799590924c852049575cec6513f4c4c3b3282
