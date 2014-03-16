<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-id=<?php echo $idea['Idea']['id']; ?>>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-color">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class = "row">  
          <h1 class="modal-title inline-block padding-left-10" id="myModalLabel" style="color:white;">
            <?php echo $idea['Idea']['name']; ?>
          </h1>
          <div class="admin-btn-md inline-block padding-left-10">
              <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>
          </div>
          <div id="modal-edit-email-btn">
            <?php echo $this->Html->link("", 
              array('controller' => 'ideas', 'action' => 'edit', $idea['Idea']['id'])
              ,array('class' =>'icon-btn admin-btn-md admin-btn-edit-white', )
             ); ?>
            <?php echo $this->Html->link("",
              array('controller' => 'ideas', 'action' => 'email', $idea['Idea']['id'])
              ,array('class' =>'icon-btn admin-btn-md email-btn', 'target' => '_blank')
            ); ?>
          </div>
        </div>
      </div>
      <div class="no-margin row well modal-body" style="background-color:white;">
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
            	<div class="desc-width">
	              <strong>Description</strong><br>
	              <?php echo $idea['Idea']['description']; ?>
              	</div>
            </div>
          </div>
          <div class = "row padding-top-10 padding-left-30">
          <!-- The Comments details of an Idea --> 
            <div class = "row"> 
              <strong>Comments</strong>
              <div class="commentblock">
                <ul>
                  <?php foreach ($comments as $comment): ?>
                  <li class="row">
                    <div class= "col-xs-1 comment-avatar">
                      <img src="img/person.png">
                    </div>
                    <div class="col-xs-11">
                      <div class="comment-message"><?php echo $comment['Comment']['message']; ?></div>
                      <div class="comment-user"><?php echo '- ' . $comment['User']['name']; ?></div>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class = "row padding-top-10" id="comment-field">
              <label for"commentField">Leave a comment</label>
              <textarea type="text" class="form-control" id="commentField" cols="30" rows"12" placeholder="Leave a comment"> </textarea>
            </div>
            <div class="row padding-top-10">
              <div class="btn btn-primary commentbtn">Comment</div>
            </div>
            <!-- The Sharing details of an Idea -->
            <div class="row padding-top-10">
              <?php echo $this->Form->textarea('share', 
                array('class' => 'sharing-autocomplete','id' => 'e18'
                )); ?>
            </div>
            <div class="row padding-top-10">                          
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
      <div class="modal-footer modal-header-color no-margin">
      </div>
    </div>
  </div>
</div>