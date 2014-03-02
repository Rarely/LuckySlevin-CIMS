<div class="bg-success">
<?php echo $this->Session->flash(); ?>
</div>
<h2>Active Ideas</h2>
<?php echo $this->element('idealist', array("ideas" => $ideas_active)) ?>
<h2>Inactive Ideas</h2>
<?php echo $this->element('idealist', array("ideas" => $ideas_inactive)) ?>
<h2>Recently Created Ideas</h2>
<?php echo $this->element('idealist', array("ideas" => $ideas_recent)) ?>



