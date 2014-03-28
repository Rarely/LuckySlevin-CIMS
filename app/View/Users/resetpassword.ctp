<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('login.css');
  echo $this->Html->css('style.css');
?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" href="img/appicon.png"/>
<link rel="shortcut icon" sizes="120x120" href="img/appicon.png" />
<link rel="shortcut icon" href="img/appicon.png" type="image/x-icon">

<div class="container">
  <div class="row">
    <div class="col-xs-12 passwordform">
        <?php echo $this->Form->create('User', array(
          'url' => array('controller' => 'users', 'action' => 'resetpassword'),
          'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
          ),
          'class' => 'well-top-margin well',    

        )); ?>

        <div class="resetheader">
          <h1>Reset Password</h1>
          <h5>Please enter your email to continue the password reset process</h5>
        </div>

        <fieldset>
          <?php echo $this->Form->input('email', array(
            'label' => '',
            'placeholder' => 'Email…',
            'required' => true
          )); ?>
          <?php echo $this->Form->submit('Reset Password', array(
            'div' => false,
            'class' => 'btn btn-primary'
          )); ?>
        </fieldset>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>