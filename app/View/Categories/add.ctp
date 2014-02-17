<!-- File: /app/View/Posts/add.ctp -->

<h1>Create Category</h1>
<?php echo $this->Form->create('Category', array(
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
      'placeholder' => 'Category Name',
    )); ?>

    <!-- This should some (comma-separated?) list input, or multi-input (possibly)-->
    <?php echo $this->Form->input('values', array(
      'label' => 'Values',
      'placeholder' => 'Category Values',
      )); ?>

    <?php echo $this->Form->submit('Submit', array(
      'div' => 'form-group',
      'class' => 'btn btn-primary'
    )); ?>

  </fieldset>