<div id="ideacontainer">
    <?php foreach ($ideas as $idea): ?>
        <?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    <?php endforeach; ?>
    <?php unset($idea); ?>
</div>