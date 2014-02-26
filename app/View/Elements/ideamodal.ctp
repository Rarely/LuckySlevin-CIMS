<?php
//TODO: FINISH MOVING IDEA TO MODAL
?>
<div class="modal fade" <?php echo "id=\"largeIdea" . $idea['Idea']['id'] . "\"" ?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel">
            <?php echo $idea['Idea']['name']; ?>
        </h2>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create('Idea', array(
          'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
            ),
          'class' => 'well'
          )); ?>
          <div class="row">
            <!--The leftside details of an Idea -->
            <div class="col-md-6">
              <strong>Community Partner</strong><br>
              <?php echo $idea['Idea']['name']; ?><br>
              <strong>Contact Name</strong><br>
              Need this Field<br>
              <strong>Contact Details</strong><br>
              Need this Frield<br>
              <strong>Project Type</strong><br>
              Need this Field<br>
              <strong>Theme</strong><br>
              Need this Field<br>
              <strong>Referral Source</strong><br>
              Need this Field<br>
              <Strong>Timeframe</Strong><br>
              Need this field<br>
              <strong>Status</strong><br>
              <?php echo $idea['Idea']['status']; ?> <br>
            </div>
            <!--The Description details of an Idea -->                      
            <div class="col-md-6">
              Description:<br>
              <?php echo $idea['Idea']['description']; ?>
            </div>
          </div>
          <div class="modal-footer">
            <?php
            $comments = (!isset($idea['Comments']) || is_null($idea['Comments'])) ? null : $idea['Comments'];
            $comments = (is_null($comments) && isset($idea['Idea']['Comments'])) ? $idea['Idea']['Comments'] : $comments;
            $comments = (is_null($comments)) ? array() : $comments;
            ?>

            Comments:<br>
            <?php foreach ($comments as $comment): ?>
              <?php echo $comment['message'], '<br>'; ?>
            <?php endforeach; ?>

            <?php echo $this->Form->input('comments', array(
              'label' => 'Leave a comment',
              'placeholder' => 'Type a comment~!',
              )); ?>

             <?php echo $this->Form->submit('Comment', array(
              'div' => 'form-group',
              'class' => 'btn btn-primary'
              )); ?>
              <div class="row">
                <div class="col-sm-10">
                 <?php echo $this->Form->input('share', array(
                  'class' => 'sharing-autocomplete'
                  ,'id' => 'e18'
                  )); ?>
                </div>
                <div class="col-sm-2">
                  <div class="btn btn-info btn-share">Share</div>
                </div>
              </div>
             <?php echo $this->Form->submit('Edit', array(
              'div' => 'form-group',
              'class' => 'btn btn-primary'
              )); ?>
              <button type="button" class="btn btn-default" data-dismiss="modal">
               Close
             </button>
           </div>
         </div>
       </div>
     </div>
   </div>