<?php echo $this->Html->script('categories.js'); ?>

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
       'options' => array('open'=>'Open', 'referred'=>'In Progress', 'matched'=>'Matched'),
       'default' => $idea['Idea']['status']
    )); ?>

    <?php foreach ($categories as $category) { ?>
      <label for="categoryDescription"><?php echo $category['Category']['name'] ?></label>
      <input type='hidden' class="cat" id='tags'
      <?php if ($category['Category']['multiselect'] == true) { echo 'multiple="true"'; } ?>
      <?php if ($category['Category']['specifiable'] == true) { echo 'specifiable="true"'; } ?>
      <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
       style='width:100%' />
      <br />
    <?php } ?>

    <?php echo $this->Form->submit('Save', array(
      'div' => 'form-group',
      'class' => 'btn btn-primary'
    )); ?>

</fieldset>

