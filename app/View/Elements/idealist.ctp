<div class="idealist-container well">
    <div class="idealist-title">
        <?php echo "<h1>" . $title . "</h1>" . "<h4>" . $subtitle . "</h4>" ?>
    </div>
    <div class="ideacontainer ideacontainer-standard">
	   <?php if(sizeof($ideas) == 0){
            echo '<div class="idea-empty-list"><h1 align="center">' . $emptymessage . '</h1></div>';
       }else{ ?>
        <div class="idea-list-innerwrap">
    		<?php foreach ($ideas as &$idea): ?>
    			<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    		<?php endforeach; ?>
    	</div>

        <?php } ?>
    </div>
</div>