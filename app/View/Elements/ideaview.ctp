<div class="ideablock btn btn-primary btn-lg" 
        <?php echo "data-id=\"" . $idea['Idea']['id'] . "\"" ?>
        onclick="Ajax.Idea.showIdea(<?php echo $idea['Idea']['id']?>);return false;"> 
        
        <h4>
         <div class="heading1">
            <div class="text-wrapper">
              <?php echo $idea['Idea']['name']; ?>
            </div>
          </div>
        </h4> <br>
        
        <?php echo $idea['Idea']['status']; ?> <br>
  <div class="idea-actions">
   <?php $trackclass = (in_array($idea['Idea']['id'], $trackings)) ? "untrackbtn" : "trackbtn"; ?>
   <div class="idea-action-btn <?php echo $trackclass ?>" 
     <?php if (in_array($idea['Idea']['id'], $trackings)) { ?>
       onclick="event.stopPropagation();Ajax.untrackIdea(this, <?php echo $idea['Idea']['id']?>);">
     <?php } else { ?>
       onclick="event.stopPropagation();Ajax.trackIdea(this, <?php echo $idea['Idea']['id']?>);">
     <?php } ?>
   </div>
  </div>
</div>

