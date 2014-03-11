<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-id=<?php echo $idea['Idea']['id']; ?>>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class = "row" style="float:right;">
            <?php echo $this->Html->link("", 
              array('controller' => 'ideas', 'action' => 'edit',$idea['Idea']['id'])
              ,array('class' =>'admin-btn admin-btn-sm admin-btn-edit')
             ); ?>
            <?php echo $this->Html->link('Email', array('controller' => 'ideas', 
              'action' => 'email', 
              $idea['Idea']['id'])
              , array('class' =>'btn btn-default', 'target' => '_blank')
            ); ?>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class = "row">  
          <h1 class="modal-title" id="myModalLabel" style="display: inline-block;">
            <?php echo $idea['Idea']['name']; ?>
          </h1>
          <div style="display: inline-block;">
              <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>        
          </div>    
        </div>
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
          <div class = "row">
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
            <div class="col-md-8">
              Description:<br>
              <?php echo $idea['Idea']['description']; ?>
            </div>
          </div>
          <div class = "row"> 
            <div class = "row"> 
              <strong>Comments:</strong>
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
            </div>
            <div class = "row">    
              <label for"commentField">Leave a comment</label>
              <textarea type="text" class="form-control" id="commentField" cols="30" rows"12" placeholder="Leave a comment"> </textarea>
            </div>
            <div = class = "row">
              <div class="btn btn-primary commentbtn">Comment</div>
            </div>
          </div>    
            <div class="row">
              <div class="col-sm-10">
               <?php echo $this->Form->textarea('share', array(
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
        </div>
      </div>
    </div>
  </div>
</div>