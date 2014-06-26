<div class="bg-success">
<?php echo $this->Session->flash('ideas'); ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_active,
                            "title" => "Active ideas",
                            "subtitle" => "Ideas most recently updated or commented on",
                            "emptymessage" => "No active ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_recent,
                            "title" => "Recently created ideas",
                            "subtitle" => "Ideas most recently created",
                            "emptymessage" => "No recently created ideas")) ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_inactive,
                            "title" => "Inactive ideas",
                            "subtitle" => "Ideas least recently updated or commented on",
                            "emptymessage" => "No inactive ideas")) ?>
</div>

