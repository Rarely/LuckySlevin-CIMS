<div class="bg-success">
<?php echo $this->Session->flash(); ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_active, "title" => "Active ideas", "subtitle" => "Ideas most recently updated or commented on")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_recent, "title" => "Recently created ideas", "subtitle" => "The most recently created ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_unassigned, "title" => "Community partner ideas", "subtitle" => "Ideas submitted by the community")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_inactive, "title" => "Inactive ideas", "subtitle" => "Ideas least recently updated or commented on")) ?>
</div>

