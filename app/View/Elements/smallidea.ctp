<?php echo $this->Html->css('style.css');?>
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#largeIdea">
	<div class=smallideablock>
  	Name:  <?php echo $idea['Idea']['name']; ?><br>
  	Status: <?php echo $idea['Idea']['status']; ?> <br>
	Description:<br>
	<div id="descriptionblock">
	 	<?php echo $idea['Idea']['description']; ?>
	</div>
	</div>
</button>

<div class="modal fade" id="largeIdea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" id="myModalLabel">
        	<?php echo $idea['Idea']['name']; ?>
        </h2>
      </div>
      <div class="modal-body">
        

<!-- File: /app/View/Posts/add.ctp -->

        <?php echo $this->Form->create('Idea', array(
          'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
          ),
          'class' => 'well'
        )); ?>
          <fieldset>
			Name:  <?php echo $idea['Idea']['name']; ?><br>
  			Status: <?php echo $idea['Idea']['status']; ?> <br>
			Description:<br>
			<div id="descriptionblock">
	 			<?php echo $idea['Idea']['description']; ?>
			</div>

          </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close
        </button>
        <?php echo $this->Form->submit('Edit', array(
              'div' => 'form-group',
              'class' => 'btn btn-primary'
            )); ?>        
      </div>
    </div>
  </div>
</div>