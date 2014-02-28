<div class="ideablock btn btn-primary btn-lg" 
        <?php echo "data-id=\"" . $idea['Idea']['id'] . "\"" ?>
        onclick="Ajax.Idea.showIdea(<?= $idea['Idea']['id']?>);return false;">     
  Name:  <?php echo $idea['Idea']['name']; ?> <br>
  Status: <?php echo $idea['Idea']['status']; ?> <br>
  Description: <br>

  <div class="descriptionblock">
    <?php echo $idea['Idea']['description']; ?>
  </div>
  <div class="idea-actions">
    <div class="btn btn-default trackbtn" onclick="event.stopPropagation();Ajax.<?= in_array($idea['Idea']['id'], $trackings) ? "un" : "" ?>trackIdea(this, <?=$idea['Idea']['id']?>);"><?= in_array($idea['Idea']['id'], $trackings) ? "Untrack" : "Track" ?></div>
  </div>
</div>
