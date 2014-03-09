<!-- File: /app/View/Tracking/index.ctp -->

<?php echo $this->element('idealist', array("ideas" => $ideas, "title" => "Ideas you are tracking")); ?>

<?php echo $this->element('idealist', array("ideas" => $ownedideas, "title" => "Ideas you own")); ?>

