<div id="view_page">
    <h2>New Password</h2>
    
<?php echo $this->Form->create('User', array(
  'url' => array('controller' => 'users', 'action' => 'newpassword'),
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
)); ?>

<fieldset>
    <?php echo $this->Form->input('password', array(
      'label' => 'Password',
      'placeholder' => ''
    )); ?>
    <?php echo $this->Form->submit('Set New Password', array(
      'div' => false,
      'class' => 'btn btn-primary'
    )); ?>
</fieldset>
</div>
