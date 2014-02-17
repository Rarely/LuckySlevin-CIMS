<h1>Ideas</h1>
<div id="ideacontainer">
    <?php foreach ($ideas as $idea): ?>
        <?php echo $this->element('smallidea', array("idea" => $idea)); ?>
    <?php endforeach; ?>
    <?php unset($idea); ?>
</div>