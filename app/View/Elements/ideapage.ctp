<div class="ideapage-container well">
   
    <div  id="ideacontainer" class="ideacontainer-search">
    	<div id="Grid">
    		<?php foreach ($ideas as &$idea): ?>
    			<?php echo $this->element('ideaview', array("idea" => $idea)); ?>
    		<?php endforeach; ?>
    	</div>
    </div>
</div>