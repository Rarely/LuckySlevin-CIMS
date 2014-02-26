<?php echo $this->Html->css('style.css');?>
<div id="ideacontainer">
    <?php foreach ($ideas as &$idea): ?>
        <?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    <?php endforeach; ?>
</div>