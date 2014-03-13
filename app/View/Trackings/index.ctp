<!-- File: /app/View/Tracking/index.ctp -->
<div class="row">
  <?php if(count($ownedideas) < 1){ ?>
  <div class="ideacontainer well empty-list">
    <h1 class="text-center">You do not own any ideas</h1>
  </div>
  <?php }else{ 
    echo $this->element('idealist', array("ideas" => $ownedideas, "title" => "Ideas you own"));
  }?>
</div>

<div class="row">
 	<?php if(count($trackings) < 1){?>
  <div class="ideacontainer well empty-list">
    <h1 class="text-center">You are not tracking any ideas</h1>
  </div>
  <?php }else{
    echo $this->element('idealist', array("ideas" => $ideas, "title" => "Ideas you are tracking"));
  }?>              	
</div>
