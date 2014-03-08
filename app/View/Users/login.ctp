<!-- File: /app/View/Users/login.ctp -->


<head>
  <link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="http://sscol.jebal.comuv.com/css/font.css">
</head>

<?php
  echo $this->Html->script('jquery-1.11.0.min.js');

  echo $this->Html->css('login.css');
?>



<body>
  <div class="top-buffer"></div>
  <div class="login">
  <h1>Centre for Community Engaged Learning</h1>
  <h1>Idea Management System</h1>

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
    'wrapInput' => false
  ),
  'class' => 'well'
)); ?>
    <div class="input">
      <div class="blockinput">
        
      <?php echo $this->Form->input('username', array(
      'between' =>  '<i class="icon-envelope-alt"></i>',
      'label' => '',
      'placeholder' => 'Email…',
    )); ?>
      </div>
      <div class="blockinput">
         <?php echo $this->Form->input('password', array(
       'between' => '<i class="icon-unlock"></i>',   
      'label' => '',
       'placeholder' => 'Password..',
    )); ?>
      </div>
    </div>
     <?php echo $this->Form->submit('Login', array(
        'div' => false,
        'class' => 'btn btn-login'
      )); ?>
      <?php echo $this->Html->link(
          'Forgot your password?'
          ,array('controller' => 'users', 'action' => 'resetpassword')
          ,array('class' => 'reset-buffer btn btn-danger pull-right')
          ); ?>
 <?php echo $this->Form->end(); ?>
  </div>
  </body>
