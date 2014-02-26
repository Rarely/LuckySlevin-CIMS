<!-- Button trigger modal -->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Add a New Idea
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel">Add a New Idea</h2>
      </div>
      <div class="modal-body">
        

<!-- File: /app/View/Posts/add.ctp -->

        <?php echo $this->Form->create('Idea', array(
          'url' => array('controller' => 'ideas', 'action' => 'add'),
          'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
          ),
          'class' => 'well'
        )); ?>
          <fieldset>
            <?php echo $this->Form->input('name', array(
              'label' => 'Idea Name',
              'placeholder' => 'Idea Name',
            )); ?>

            <?php echo $this->Form->input('community_partner', array(
              'label' => 'Community Partner',
              'placeholder' => 'Community Partner',
            )); ?>

            <?php echo $this->Form->input('contact_name', array(
              'label' => 'Contact Name',
              'placeholder' => 'Contact Name',
            )); ?>

            <?php echo $this->Form->input('contact_email', array(
              'label' => 'Contact Email',
              'placeholder' => 'Contact Email',
            )); ?>

            <?php echo $this->Form->input('description', array(
              'label' => 'Description',
              'placeholder' => 'Insert a description here',
              )); ?>

            <?php             
            $status = array('Open' => 'Open', 'InProgress' => 'In Progress', 'Matched' => 'Matched');
            echo $this->Form->input('status', 
             array('options' => $status, 'default' => 'Open'
             )); ?>
             
            <?php echo $this->Form->input('userid', array(
             'label' => 'UserId',
             'placeholder' => 'THIS IS TEMPORARY UNTIL WE FIX THIS'
             )); ?>  
           </fieldset>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo $this->Form->submit('Submit', array(
              'div' => 'form-group',
              'class' => 'btn btn-primary'
            )); ?>
      </div>
    </div>
  </div>
</div>