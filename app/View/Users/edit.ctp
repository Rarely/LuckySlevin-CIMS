<!-- app/View/Users/edit.ctp -->
<?php echo $this->Html->css('users.css'); ?>

<div class="row well users-well">
  <h1>Edit User</h1>
    <?php echo $this->Html->link("<span class=\"glyphicon glyphicon-arrow-left\"></span> Back to Users",
         array('controller' => 'users', 'action' => 'index'), array('class'=> 'btn btn-default','escape'=> false)); ?>
  <?php echo $this->Form->create('User', array(
    'inputDefaults' => array(
      'div' => 'form-group',
      'wrapInput' => false,
      'class' => 'form-control'
  ))); ?>
    <fieldset>
      <?php echo $this->Form->input('name', array(
        'label' => 'Name',
        'value' => $user['User']['name'],
      )); ?>

      <?php echo $this->Form->input('username', array(
        'label' => 'Email',
        'value' => $user['User']['username'],
      )); ?>

      <?php echo $this->Form->input('role', array(
        'options' => array('standard' => 'Standard','admin' => 'Admin'),
        'default' => array('standard' => 'Standard')
      )); ?>

      <?php echo $this->Form->submit('Submit', array(
        'div' => 'form-group',
        'class' => 'btn btn-primary'
      )); ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>