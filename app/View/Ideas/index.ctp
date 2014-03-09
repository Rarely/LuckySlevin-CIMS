<div class="bg-success">
<?php echo $this->Session->flash(); ?>
</div>
<?php echo $this->element('idealist', array("ideas" => $ideas_active, "title" => "Active ideas")) ?>
<?php echo $this->element('idealist', array("ideas" => $ideas_inactive, "title" => "Inactive ideas")) ?>
<?php echo $this->element('idealist', array("ideas" => $ideas_recent, "title" => "Recently created ideas")) ?>


