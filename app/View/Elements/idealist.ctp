<div class="idealist-container well">
    <div class="idealist-title">
        <?php echo "<h1>" . $title . "<span>" . "<h5>" . $subtitle . "</h5>" . "</span>" . "</h1>"?>
    </div>
    <div id="ideacontainer" class="ideacontainer">
    	<div class="idea-list-innerwrap">
    		<?php foreach ($ideas as &$idea): ?>
    			<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    		<?php endforeach; ?>
    	</div>
    </div>
</div>