<div class="modal fade" id="ajax-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-id=<?php echo $idea['Idea']['id']; ?>>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-color">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class = "row">  
          <h1 class="modal-title inline-block padding-left-10" id="myModalLabel" style="color:white;">
            <?php echo h($idea['Idea']['name']); ?>
          </h1>
          <div class="admin-btn-md inline-block padding-left-10">
              <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>
          </div>
          <div id="modal-edit-email-btn" class="dropdown">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              <img src="/img/options.png" alt="" />
              Options <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
              <li>
                <?php echo $this->Html->link('<img src="/img/editoptions.png" alt="">Edit',
                array('controller' => 'ideas', 'action' => 'edit', $idea['Idea']['id']),
                array('escape' => false)); ?>
              </li>
              <li>
                <a href="#" class="split-btn"><img src="/img/split.png" alt="" />Split</a>
              </li>
              <li>
                <?php echo $this->Html->link('<img src="/img/email.png" alt=""/>Email',
                array('controller' => 'ideas', 'action' => 'email', $idea['Idea']['id']),
                array('escape' => false)); ?>
              </li>
            </ul>
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
        <div class="col-md-7">
          <!--The leftside details of an Idea -->
          <div class = "row">
            <div class="col-md-4">
              <strong>Community Partner</strong><br>
              <span class="community_partner"><?php echo h($idea['Idea']['community_partner']); ?></span><br>
              <strong>Contact Name</strong><br>
              <span class="contact_name"><?php echo h($idea['Idea']['contact_name']); ?></span>
              <br>
              <strong>Contact Details</strong><br>
              <span class="contact_email"><?php echo h($idea['Idea']['contact_email']); ?></span>
              <br>
              <?php if(h($idea['Idea']['contact_phone']) != '') {
                        echo '<span class="contact_phone">' . h($idea['Idea']['contact_phone']) . '</span>'; ?>
                    <br> <?php } ?>
              <Strong>Timeframe</Strong><br>
              <?php if($idea['Idea']['start_date'] == null && $idea['Idea']['end_date'] == null){?>
                  Flexible<br> <?php } ?>
              <?php if($idea['Idea']['start_date'] != null) {  
                         echo "Start Date: ";  
                         echo $idea['Idea']['start_date'];?>
                    <br> <?php } ?>
              <?php if($idea['Idea']['end_date'] != null) {  
                         echo "End Date: ";   
                         echo $idea['Idea']['end_date'];?>
                    <br> <?php } ?>
            </div>
            <!--The Description details of an Idea -->                      
            <div class="col-md-8">
            	<div class="desc-width">
	              <strong>Description</strong><br>
	              <?php echo h($idea['Idea']['description']); ?>
              </div>
              <strong>Owner</strong><br>
              <?php echo h($idea['Users']['name']); ?><br>
              <strong>Referred Ideas</strong><br>
               <ul class="references-list">
                <?php
                 if (count($idea['References'])) {
                    foreach($idea['References'] as $ref) {
                     echo '<li><a onclick="Ajax.Idea.showIdea(' . $ref['id'] . ');">' . h($ref['name']) . '</a></li>';
                    }
                 } else {
                   echo "<li>No Ideas Referred</li>";
                 }
                ?>
              </ul>
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
                      <div class="comment-message"><?php echo h($comment['Comment']['message']); ?></div>
                      <div class="comment-user"><?php echo '- ' . h($comment['User']['name']) . ' ' . $comment['Comment']['created']; ?></div>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <div class = "row padding-top-10" id="comment-field">
              <textarea type="text" class="form-control" id="commentField" cols="30" rows"12" placeholder="Leave a comment"></textarea>
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
        <div class="col-md-1">
        <!--This Spacing is here for mobile reasons, remove it causes the large mobile to render incorrectly -->
        </div>
        <!--The Rightside of an Idea -->
        <div class="col-md-4">
          <?php foreach($categories as $cat) { ?>
          <strong><?php echo h($cat['Category']['name']) ?>:</strong>
            <ul>
              <?php $found = false; ?>
              <?php foreach($ideavalues as $value) { ?>
                <?php if ($value['Value']['categoryid'] == $cat['Category']['id']) { ?>
                  <?php $found = true; ?>
                  <li><?php echo h($value['Value']['name']); ?></li>
                  <?php } ?>
              <?php } 
              if(!$found){ ?>
                No value specified
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