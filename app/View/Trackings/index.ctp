<!-- File: /app/View/Tracking/index.ctp -->
<div class="row">
  <?php  
    echo $this->element('idealist', array("ideas" => $ownedideas,
                          "title" => "Ideas you own",
                          "subtitle" => "You will receive notifications when these ideas are updated or commented on",
                            "emptymessage" => "You do not own any ideas"));?>
</div>

<div class="row">
  <?php
    echo $this->element('idealist', array("ideas" => $ideas,
                          "title" => "Ideas you are tracking",
                          "subtitle" => "You will receive notifications when these ideas are updated or commented on",
                            "emptymessage" => "You are not tracking any ideas"));?>              	
</div>
<?php if ($userData['role'] == 'admin') { ?>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas_unassigned,
                            "title" => "Community partner ideas",
                            "subtitle" => "Ideas submitted by the community",
                            "emptymessage" => "No ideas submitted by the community")) ?>
</div>
<?php } ?>