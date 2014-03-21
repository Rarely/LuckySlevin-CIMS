<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
?>
<div class="row well well-top-margin">
    <h3>New Password</h3>
    
<?php echo $this->Form->create('User', array(
  'url' => array('controller' => 'users', 'action' => 'newpassword'),
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
)); ?>

<fieldset>
    <?php echo $this->Form->input('password', array(
      'label' => 'Password',
      'placeholder' => '',
      'value' => ''
    )); ?>
    <?php echo $this->Form->submit('Set New Password', array(
      'div' => false,
      'class' => 'btn btn-primary'
    )); ?>
</fieldset>
<?php echo $this->Form->end(); ?>
</div>
