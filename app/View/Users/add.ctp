<!-- File: /app/View/Posts/add.ctp -->

<h1>Create User</h1>
<?php echo $this->Form->create('User', array(
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
)); ?>
  <fieldset>
    <?php echo $this->Form->input('name', array(
      'label' => 'Name',
      'placeholder' => 'Name',
    )); ?>

    <?php echo $this->Form->input('email', array(
      'label' => 'Email',
      'placeholder' => 'Email…',
    )); ?>
    
    <?php echo $this->Form->input('password', array(
      'label' => 'Password',
    )); ?>

    <?php echo $this->Form->input('role', array(
      'options' => array('Basic', 'Admin'),
      'empty' => 'Choose One'
    )); ?>

    <?php echo $this->Form->submit('Submit', array(
      'div' => 'form-group',
      'class' => 'btn btn-primary'
    )); ?>

  </fieldset>