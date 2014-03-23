<div class="idealist-container well">
    <div class="idealist-title">
        <?php echo "<h1>" . $title . "</h1>" . "<h4>" . $subtitle . "</h4>" ?>
    </div>
    <div class="ideacontainer ideacontainer-standard">
    	<div class="idea-list-innerwrap">
    		<?php foreach ($ideas as &$idea): ?>
    			<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    		<?php endforeach; ?>
    	</div>
    </div>
</div>