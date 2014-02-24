<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title_for_layout?></title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');

echo $this->Html->script('jquery-1.11.0.min.js');
echo $this->Js->writeBuffer();
//custom css
echo $this->Html->css('bootstrap.css');
echo $this->Html->script('bootstrap.min.js');
?>
<style type="text/css">
body {
  padding-top: 60px;
}
</style>
</head>
<body>

    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar">&nbsp;</span>
            <span class="icon-bar">&nbsp;</span>
            <span class="icon-bar">&nbsp;</span>
          </button>
          <a class="navbar-brand" href="#">CIMS</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><?php echo $this->Html->link('Home', array('controller'=>'ideas', 'action'=>'index'));?></li>
            <li><?php echo $this->Html->link('Search', array('controller'=>'search', 'action'=>'index'));?></li>
            <li><?php echo $this->Html->link('Trackings', array('controller'=>'trackings', 'action'=>'index'));?></li>
            <?php if ($userData['role'] == 'admin') { ?>
            <li><?php echo $this->Html->link('Users', array('controller'=>'users', 'action'=>'index'));?></li>
            <?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><?php echo $this->Html->link('Notifications', array('controller'=>'users', 'action'=>'notifications'));?></li>
            <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));?></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <?php echo $this->fetch('content'); ?>
    </div> <!-- /container -->

</body>
</html>