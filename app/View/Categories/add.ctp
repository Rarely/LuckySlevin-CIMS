<!-- File: /app/View/Categories/add.ctp -->

<h1>Create Value</h1>
<?php echo $this->Form->create('Value', array(
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
)); ?>
  <fieldset>
  <!-- The category name -->
    <?php echo $this->Form->input('name', array(
      'label' => 'Name',
      'placeholder' => 'Value Name',
    )); ?>

    <?php echo $this->Form->submit('Submit', array(
      'div' => 'form-group',
      'class' => 'btn btn-primary'
    )); ?>

  </fieldset>
  <?php echo $this->Form->end(); ?>