<div class="bg-success">
<?php echo $this->Session->flash(); ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_active, "title" => "Active ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_inactive, "title" => "Inactive ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_recent, "title" => "Recently created ideas")) ?>
</div>

