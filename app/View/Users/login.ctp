<!-- File: /app/View/Users/login.ctp -->
<h1>Login</h1>
<?php if ($this->Session->flash('auth') != false) { ?>
    <div class="bg-danger" style="">
        <?php echo $this->Session->flash('auth'); ?>
    </div>
<?php } ?>

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

    <?php echo $this->Form->submit('Login', array(
      'div' => 'form-group',
      'class' => 'btn btn-primary'
    )); ?>
</fieldset>