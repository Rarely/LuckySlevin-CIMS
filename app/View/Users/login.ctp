<!-- File: /app/View/Users/login.ctp -->
<?php
  echo $this->Html->script('jquery-1.11.0.min.js');
  echo $this->Html->css('bootstrap.css');
  echo $this->Html->script('bootstrap.min.js');
?>


<h1>Login</h1>
<?php if ($this->Session->flash('auth') != false) { ?>
    <div class="bg-danger" style="">
        <?php echo $this->Session->flash('auth'); ?>
    </div>
<?php } ?>
<div class="bg-success">
<?php echo $this->Session->flash(); ?>
</div>

<?php echo $this->Form->create('User', array(
  'url' => array('controller' => 'users', 'action' => 'login'),
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'class' => 'well'
)); ?>

<fieldset>
    <?php echo $this->Form->input('username', array(
      'label' => 'Email',
      'placeholder' => 'Email…',
    )); ?>
    
    <?php echo $this->Form->input('password', array(
      'label' => 'Password',
    )); ?>

    <div class="form-group">
      <?php echo $this->Form->submit('Login', array(
        'div' => false,
        'class' => 'btn btn-primary'
      )); ?>
      <?php echo $this->Html->link(
          'Forgot Password'
          ,array('controller' => 'users', 'action' => 'resetpassword')
          ,array('class' => 'btn btn-default pull-right')
          ); ?>
    </div>
</fieldset>
<?php echo $this->Form->end(); ?>