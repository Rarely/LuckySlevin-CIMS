 <div class="idea-actions inline-block" data-id="<?php echo $idea['Idea']['id'] ?>">
  <?php $trackclass = (in_array($idea['Idea']['id'], $trackings)) ? "untrackbtn" : "trackbtn"; ?>
  <div class="idea-tracking-btn <?php echo $trackclass ?>"
    <?php if (in_array($idea['Idea']['id'], $trackings)) { ?>
     title="Untrack" onclick="event.stopPropagation();Ajax.untrackIdea(<?php echo $idea['Idea']['id']?>);">
    <?php } else { ?>
     title="Track" onclick="event.stopPropagation();Ajax.trackIdea(<?php echo $idea['Idea']['id']?>);">
    <?php } ?>
  </div>
</div>