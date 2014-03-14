<div class="bg-success">
<?php echo $this->Session->flash(); ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_active, "title" => "Active ideas", "subtitle" => "The latest updated or commented on ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_recent, "title" => "Recently created ideas", "subtitle" => "The most newly created ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_unassigned, "title" => "Community partner ideas", "subtitle" => "Ideas submitted by the community")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_inactive, "title" => "Inactive ideas", "subtitle" => "The least updated and commented on ideas")) ?>
</div>

