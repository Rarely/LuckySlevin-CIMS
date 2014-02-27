<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-id=<?php echo $idea['Idea']['id']; ?>>
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
            <?php echo $idea['Idea']['status']; ?><br>
          </div>
          <!--The Description details of an Idea -->                      
          <div class="col-md-6">
            Description:<br>
            <?php echo $idea['Idea']['description']; ?>
          </div>
        </div>
        <div class="modal-footer">

          Comments:<br>
          <ul class="commentList">
            <?php foreach ($comments as $comment): ?>
              <?php echo '<li>'. $comment['User']['name'] . ': ' . $comment['Comment']['message'], '</li>'; ?>
            <?php endforeach; ?>
          </ul> 
          <div class="form-group">
            <label for"commentField">Leave a Comment</label>
            <input type="text" class="form-control" id="commentField" placeholder="Leave a Comment" />
            <div class="btn btn-default commentbtn">Comment</div>
          </div>

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
          <?php echo $this->Html->link('Edit', array('controller' => 'ideas', 
            'action' => 'edit', 
            $idea['Idea']['id'])
            , array('class' =>'btn btn-default')
          ); ?>

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>