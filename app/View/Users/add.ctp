<!-- app/View/Users/add.ctp -->
<?php echo $this->Html->css('users.css'); ?>

<div class="row well users-well">
  <h1>Create User</h1>
  <?php echo $this->Form->create('User', array(
    'inputDefaults' => array(
      'div' => 'form-group',
      'wrapInput' => false,
      'class' => 'form-control'
  ))); ?>
    <fieldset>
      <?php echo $this->Form->input('name', array(
        'label' => 'Name',
        'placeholder' => 'Name',
        'required' => true
      )); ?>

      <?php echo $this->Form->input('username', array(
        'label' => 'Email',
        'placeholder' => 'Email',
        'required' => true
      )); ?>

      <?php echo $this->Form->input('role', array(
        'options' => array('standard' => 'Standard','admin' => 'Admin'),
        'default' => array('standard' => 'Standard')
      )); ?>

      <?php echo $this->Form->submit('Submit', array(
        'div' => 'form-group save-btn',
        'class' => 'btn btn-primary'
      )); ?>
    </fieldset>
  <?php echo $this->Form->end(); ?>
</div>