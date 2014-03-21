<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
?>
<div class="row well well-top-margin">
<h3>Reset Lost Password</h3>
<?php echo $this->Form->create('User', array(
  'url' => array('controller' => 'users', 'action' => 'resetpassword'),
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  )
)); ?>

<fieldset>
    <?php echo $this->Form->input('email', array(
      'label' => 'Email',
      'placeholder' => 'Email…',
    )); ?>
    <?php echo $this->Form->submit('Reset Password', array(
      'div' => false,
      'class' => 'btn btn-primary'
    )); ?>
</fieldset>
<?php echo $this->Form->end(); ?>
</div>