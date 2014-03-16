<!-- File: /app/View/Users/login.ctp -->
<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
  echo $this->Html->css('login.css');
?>


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
        <h2>Idea Management System</h2> 
      </div>
    </div>
    <div class="row">
      <?php if ($this->Session->flash('auth') != false) { ?>
          <div class="bg-danger" style="">
            <?php echo $this->Session->flash('auth'); ?>
          </div>
      <?php } ?>
          <div class="bg-success">
      <?php echo $this->Session->flash(); ?>
      </div>
    </div>
    <fieldset>
      <div class="row">
        <?php echo $this->Form->input('username', array(
          'label' => '',
          'placeholder' => ' Email address',
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
            'class' => 'btn btn-login'
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
      </div>
    </fieldset>
    <?php echo $this->Form->end(); ?>
  </div>

