<div class="ideapage-container well">
   
    <div class="ideacontainer ideacontainer-search">
        <?php if(sizeof($ideas) == 0){
            echo '<div class="idea-empty-list"><h1 align="center">' . $emptymessage . '</h1></div>';
        }else{ ?>
        <div id="Grid">
        	<?php foreach ($ideas as &$idea): ?>
        		<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
        	<?php endforeach; ?>
        </div>
        <?php } ?>
    </div>
</div>