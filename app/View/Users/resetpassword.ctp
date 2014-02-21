<div id="view_page">
<h2>Reset Lost Password</h2>
<?php echo $this->Form->create('User', array(
  'url' => array('controller' => 'users', 'action' => 'resetpassword'),
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
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

</div>