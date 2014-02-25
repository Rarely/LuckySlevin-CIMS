<h1> Edit an Idea </h1>

<?php echo $this->Form->create('Idea', array(
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
)); ?>

  <fieldset>
    <?php echo $this->Form->input('name', array(
      'label' => 'name',
      'value' => $idea['Idea']['name'],
    )); ?>
    
    <?php echo $this->Form->input('description', array(
      'label' => 'description',
      'value' => $idea['Idea']['description'],
    )); ?>

    <?php echo $this->Form->input('status', array(
       'options' => array('open'=>'Open', 'referred'=>'Referred', 'matched'=>'Matched'),
       'default' => $idea['Idea']['status']
    )); ?>

    <?php echo $this->Form->submit('Save', array(
      'div' => 'form-group',
      'class' => 'btn btn-primary'
    )); ?>

</fieldset>

