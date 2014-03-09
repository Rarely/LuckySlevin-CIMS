<!-- File: /app/View/Tracking/index.ctp -->
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ideas, "title" => "Ideas you are tracking")); ?>
</div>
<div class="row">
<?php echo $this->element('idealist', array("ideas" => $ownedideas, "title" => "Ideas you own")); ?>
</div>
