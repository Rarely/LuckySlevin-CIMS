<?php echo $this->Html->script('newidea.js'); ?>
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
              'rows'=>1
            )); ?>

            <?php echo $this->Form->input('contact_name', array(
              'label' => 'Contact Name',
              'placeholder' => 'Contact Name',
              'rows'=>1
            )); ?>

            <?php echo $this->Form->input('contact_email', array(
              'label' => 'Contact Email',
              'placeholder' => 'Contact Email',
              'rows'=>1
            )); ?>

            <?php echo $this->Form->input('description', array(
              'label' => 'Description',
              'placeholder' => 'Insert a description here',
              )); ?>

            <?php foreach ($categories as $category) { ?>
              <label for="categoryDescription"><?php echo $category['Category']['name'] ?></label>
              <input type='hidden' class="cat" id='tags' name="data[Category][<?php echo $category['Category']['id']; ?>]"
              <?php if ($category['Category']['multiselect'] == true) { echo 'multiple="true"'; } ?>
              <?php if ($category['Category']['specifiable'] == true) { echo 'specifiable="true"'; } ?>
              <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
               style='width:100%' />
              <br />
            <?php } ?>
           </fieldset>

      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="Submit" />
        <div class="btn btn-link" data-dismiss="modal">Cancel</div>
      </div>
    </div>
  </div>
</div>