 <div class="idea-actions" data-id="<?php echo $idea['Idea']['id'] ?>">
  <?php $trackclass = (in_array($idea['Idea']['id'], $trackings)) ? "untrackbtn" : "trackbtn"; ?>
<<<<<<< HEAD
  <div class="idea-tracking-btn <?php echo $trackclass ?>"
=======
  <div class="idea-action-btn <?php echo $trackclass ?>"
>>>>>>> c150acff435d9e05881209f0a3888c6a8e6615e0
    <?php if (in_array($idea['Idea']['id'], $trackings)) { ?>
     title="Track" onclick="event.stopPropagation();Ajax.untrackIdea(<?php echo $idea['Idea']['id']?>);">
    <?php } else { ?>
     title="Untrack" onclick="event.stopPropagation();Ajax.trackIdea(<?php echo $idea['Idea']['id']?>);">
    <?php } ?>
  </div>
</div>