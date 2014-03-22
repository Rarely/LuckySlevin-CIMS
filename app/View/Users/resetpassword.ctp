<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('login.css');
  echo $this->Html->css('style.css');
?>

<div class="row">
    <?php echo $this->Form->create('User', array(
      'url' => array('controller' => 'users', 'action' => 'resetpassword'),
      'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
      ),
      'class' => 'reset-well well',    

    )); ?>

    <div class="row">
        <div class="resetheader">
            <h1>Reset Password</h1>
            <br>
            <h5>An email will be sent to this address, please follow the process to reset your password</h5>
            <br>
        </div>
    </div>

    <fieldset>
        <div class="row">
            <?php echo $this->Form->input('email', array(
              'label' => 'Email',
              'placeholder' => 'Email…',
            )); ?>
        </div>
        <div class="row">
            <?php echo $this->Form->submit('Reset Password', array(
              'div' => false,
              'class' => 'btn btn-primary'
            )); ?>
        </div>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>