<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-id=<?php echo $idea['Idea']['id']; ?>>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title" id="myModalLabel">
          <?php echo $idea['Idea']['name']; ?>
        </h1>
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
        <div class="col-md-8">
          <!--The leftside details of an Idea -->
          <div class="col-md-4">
            <strong>Community Partner</strong><br>
            <?php echo $idea['Idea']['name']; ?><br>
            <strong>Contact Name</strong><br>
            <?php echo $idea['Idea']['contact_name']; ?><br>
            <strong>Contact Details</strong><br>
            <?php echo $idea['Idea']['contact_email']; ?><br>
            <?php echo $idea['Idea']['contact_phone']; ?><br>
            <strong>Referral Source</strong><br>
            Need this Field<br>
            <Strong>Timeframe</Strong><br>
            Need this field<br>
          </div>
          <!--The Description details of an Idea -->                      
          <div class="col-md-6">
            Description:<br>
            <?php echo $idea['Idea']['description']; ?>
          </div>
          <div class="comment-heading">Comments:</div>
            <div class="commentblock">
              <ul class="commentList">
                <?php foreach ($comments as $comment): ?>
                  <div class="comment-bg">
                    <l>
                      <p>
                        <div class="comment-message"><?php echo $comment['Comment']['message']; ?></div>
                      </p>
                      <div class="comment-user"><?php echo '- ' . $comment['User']['name']; ?></div>
                    </l>
                  </div>
                <?php endforeach; ?>
              </ul>  
            </div>  

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
        </div>
        <div class="col-md-4">
          <?php foreach($categories as $cat) { ?>
          <?php echo $cat['Category']['name'] ?>:
            <ul>
              <?php foreach($ideavalues as $value) { ?>
                <?php if ($value['Value']['categoryid'] == $cat['Category']['id']) { ?>
                  <li><?php echo $value['Value']['name']; ?></li>
                  <?php } ?>
              <?php } ?>
            </ul>
            <?php } ?>
        </div>
        <div class="modal-footer">
            <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>

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