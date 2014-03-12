<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-id=<?php echo $idea['Idea']['id']; ?>>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class = "row">  
          <h1 class="modal-title" id="myModalLabel" style="display: inline-block">
            <div style="padding-left:10px">
              <?php echo $idea['Idea']['name']; ?>
            </div>
          </h1>
          <div class="admin-btn-md" style="display: inline-block; margin-bottom:5px;">
              <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>
          </div>
          <div id="modal-edit-email-btn">
            <?php echo $this->Html->link("", 
              array('controller' => 'ideas', 'action' => 'edit', $idea['Idea']['id'])
              ,array('class' =>'icon-btn admin-btn-md admin-btn-edit', )
             ); ?>
            <?php echo $this->Html->link("",
              array('controller' => 'ideas', 'action' => 'email', $idea['Idea']['id'])
              ,array('class' =>'icon-btn admin-btn-md email-btn', 'target' => '_blank')
            ); ?>
          </div>
        </div>
      </div>
      <div class="no-margin row well modal-body" style="background-color:lightcyan;">
        <?php echo $this->Form->create('Idea', array(
          'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
            ),
        )); ?>
      <!--The Leftside of an Idea -->
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
              <strong>Description</strong><br>
              <?php echo $idea['Idea']['description']; ?>
            </div>
          </div>
          <div class = "row" style="padding-left: 30px; padding-top: 10px;">
          <!-- The Comments details of an Idea --> 
            <div class = "row"> 
              <strong>Comments</strong>
              <div class="commentblock">
                <ul class="commentList" style="padding-left:5px;">
                  <?php foreach ($comments as $comment): ?>
                    <div class="comment-bg">
                    <div class= "col-md-1" style="margin-top: 15px;">
                      <img src="img/person.png">
                    </div>
                    <div class="col-md-11">
                      <l>
                        <p>
                          <div class="comment-message"><?php echo $comment['Comment']['message']; ?><br></div>
                          <div class="comment-user"><?php echo '- ' . $comment['User']['name']; ?></div>
                        </p>
                      </l>
                     </div> 
                    </div>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class = "row" id="comment-field" style="padding-top: 10px;">
              <label for"commentField">Leave a comment</label>
              <textarea type="text" class="form-control" id="commentField" cols="30" rows"12" placeholder="Leave a comment"> </textarea>
            </div>
            <div class="row" style="padding-top: 10px;">
              <div class="btn btn-primary commentbtn">Comment</div>
            </div>
            <!-- The Sharing details of an Idea -->
            <div class="row" style="padding-top: 10px;  width: 94%; ">
              <?php echo $this->Form->textarea('share', 
                array('class' => 'sharing-autocomplete','id' => 'e18'
                )); ?>
            </div>
            <div class="row"style="padding-top: 10px;">                          
              <div class="btn btn-info btn-primary btn-share">Share</div>
            </div>
          </div>
        </div>
        <!--The Rightside of an Idea -->
        <div class="col-md-4">
          <?php foreach($categories as $cat) { ?>
          <strong><?php echo $cat['Category']['name'] ?>:</strong>
            <ul>
              <?php foreach($ideavalues as $value) { ?>
                <?php if ($value['Value']['categoryid'] == $cat['Category']['id']) { ?>
                  <li><?php echo $value['Value']['name']; ?></li>
                  <?php } ?>
              <?php } ?>
            </ul>
            <?php } ?>
        </div>
      </div>  
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>