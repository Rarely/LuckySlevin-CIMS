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

echo $this->Html->script('ajax.js');
echo $this->Html->script('autocomplete.js');
echo $this->Html->script('notifications.js');
echo $this->Html->script('custom-jquery.js');
echo $this->Html->css('style.css');

echo $this->Js->writeBuffer();
//custom css
echo $this->Html->css('bootstrap.css');
echo $this->Html->script('bootstrap.min.js');

echo $this->Html->script('select2.min.js');
echo $this->Html->css('select2.css');
echo $this->Html->css('select2-bootstrap.css');
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
            <li class="dropdown">
              <a href="#" class="dropdown-toggle notifications-btn" data-toggle="dropdown">
                Notifications <span class="badge badge-important badge-notifications"><?php echo $notificationsCount ?></span>
              </a>
              <ul class="dropdown-menu notifications-menu">
                <li><a>Loading Notifications</a></li>
              </ul>
            </li>
            <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));?></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <?php // echo $this->element('ajaxmodal'); ?>
      <?php echo $this->fetch('content'); ?>
    </div> <!-- /container -->

</body>
</html>