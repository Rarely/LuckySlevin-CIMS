<!-- File: /app/View/Users/login.ctp -->
<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('style.css');
  echo $this->Html->css('login.css');
?>

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" href="img/appicon.png"/>
<link rel="shortcut icon" sizes="120x120" href="img/appicon.png" />
<link rel="shortcut icon" href="img/appicon.png" type="image/x-icon">

  <div class="col-md-4 col-md-offset-4">
    <?php echo $this->Form->create('User', array(
      'url' => array('controller' => 'users', 'action' => 'login'),
      'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
      ),
      'class' => 'well'
    )); ?>

    <div class="row">
      <div class="loginheader">
        <h1>Centre for Community Engaged Learning </h1>
        <h3>Idea Management System</h3> 
      </div>
    </div>
    <div class="row">
      <div class="bg-success">
        <?php echo $this->Session->flash('goodlogin'); ?>
      </div>
      <div class="bg-danger">
        <?php echo $this->Session->flash('badlogin'); ?>
      </div>
    </div>
    <fieldset>
      <div class="row">
        <?php echo $this->Form->input('username', array(
          'label' => '',
          'placeholder' => ' Email',
        )); ?>
        </div>
        <div class="row">
        <?php echo $this->Form->input('password', array(
          'label' => '',
          'placeholder' => ' Password',
        )); ?>
      </div>
      <div class="form-group">
        <div class="row">
          <?php echo $this->Form->submit('Login', array(
            'div' => false,
            'class' => 'btn btn-primary btn-login'
          )); ?>
        </div>
        <div class="row">
          <div class="forgotpassword">
            <?php echo $this->Html->link('Forgot Password?', array(
              'controller' => 'users',
              'action' => 'resetpassword'
            )); ?>
          </div>
        </div>
        <div class="row">
          <div class="communitypage">
            <?php echo $this->Html->link('Looking to Submit an Idea?', array(
              'controller' => 'ideas',
              'action' => 'add_community'
            )); ?>
          </div>
        </div>
      </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
  </div>

