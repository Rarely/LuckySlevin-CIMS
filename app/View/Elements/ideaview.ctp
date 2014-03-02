<div 
        <?php echo "class=\"mix ideablock btn btn-primary btn-lg " . $idea['Idea']['status'] . "\""?>
        <?php echo "data-name=\"" . $idea['Idea']['name'] . "\""?>
        <?php echo "data-status=\"" . $idea['Idea']['status'] . "\""?>
        <?php echo "data-id=\"" . $idea['Idea']['id'] . "\"" ?>
        onclick="Ajax.Idea.showIdea(<?php echo $idea['Idea']['id']?>);return false;"> 
          <div class="row">
             <div class="title-heading">
                <div class="title-text-wrapper">
                  <?php echo $idea['Idea']['name']; ?>
                </div>
             </div>
          </div>    
          

          <div class="row">
              <div class="description-text-wrapper">
                <div class="description-heading">
                  <?php echo $idea['Idea']['description']; ?>
                </div>
              </div>
          </div>  

            <div class="row">
              <div class="status-heading">
                Status needed! Fix Me Jon
              </div>
            </div>
          <div class="row">  
            <div class="col-md-6">
              <div class="owner-heading">
                <?php echo $idea['Users']['name']; ?>
              </div>
            </div>              
            <div class="col-md-6">
                <div class="idea-actions">
                  <?php $trackclass = (in_array($idea['Idea']['id'], $trackings)) ? "untrackbtn" : "trackbtn"; ?>
                  <div class="idea-action-btn <?php echo $trackclass ?>"
                   <?php if (in_array($idea['Idea']['id'], $trackings)) { ?>
                     title="Track" onclick="event.stopPropagation();Ajax.untrackIdea(this, <?php echo $idea['Idea']['id']?>);">
                   <?php } else { ?>
                     title="Untrack" onclick="event.stopPropagation();Ajax.trackIdea(this, <?php echo $idea['Idea']['id']?>);">
                   <?php } ?>
                  </div>
                </div>
            </div>
        </div>
</div>

