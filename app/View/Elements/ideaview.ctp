<div class="ideablock btn btn-primary btn-lg" 
        <?php echo "data-id=\"" . $idea['Idea']['id'] . "\"" ?>
        onclick="Ajax.Idea.showIdea(<?php echo $idea['Idea']['id']?>);return false;">     
  Name:  <?php echo $idea['Idea']['name']; ?> <br>
  Status: <?php echo $idea['Idea']['status']; ?> <br>
  Description: <br>

  <div class="descriptionblock">
    <?php echo $idea['Idea']['description']; ?>
  </div>
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
