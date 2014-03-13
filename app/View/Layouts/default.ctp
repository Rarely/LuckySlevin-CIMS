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
echo $this->Html->script('date.js');
echo $this->Html->script('ajax.js');
echo $this->Html->script('autocomplete.js');
echo $this->Html->script('notifications.js');
echo $this->Html->script('custom-jquery.js');
echo $this->Html->script('jquery.dotdotdot.min.js');
echo $this->Html->script('ui.js');

echo $this->Js->writeBuffer();
echo $this->Html->script('bootbox.min.js');
//custom css
echo $this->Html->css('bootstrap.css');
echo $this->Html->script('bootstrap.min.js');

echo $this->Html->css('style.css');
echo $this->Html->css('comment.css');
echo $this->Html->css('layout.css');
echo $this->Html->css('idea.css');
echo $this->Html->css('admin.css');

echo $this->Html->script('select2.min.js');
echo $this->Html->css('select2.css');
echo $this->Html->css('select2-bootstrap.css');
echo $this->Html->script('users.js');

?>
<style type="text/css">
body {
  padding-top: 52px;
}
</style>
</head>
<body>
    <div id="heading-colour" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" <?php echo $this->Html->link('Home', array('controller'=>'ideas', 'action'=>'index'));?></a>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar">&nbsp;</span>
            <span class="icon-bar">&nbsp;</span>
            <span class="icon-bar">&nbsp;</span>
          </button>
        </div>

        <div class="navbar-collapse collapse">
          
          <ul class="nav navbar-nav nav-font">
            <li><?php echo $this->Html->link('Search', array('controller'=>'search', 'action'=>'index'));?></li>
            <li><?php echo $this->Html->link('My Page', array('controller'=>'trackings', 'action'=>'index'));?></li>
            <?php if ($userData['role'] == 'admin') { ?>
              <li><?php echo $this->Html->link('Users', array('controller'=>'users', 'action'=>'index'));?></li>
              <li><?php echo $this->Html->link('Categories', array('controller'=>'categories', 'action'=>'index'));?></li>
              <li><?php echo $this->Html->link('Idea Management', array('controller'=>'search', 'action'=>'index'));?></li>
            <?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">

            <li><button class="add-btn btn btn-primary btn-lg" id="btn-add-idea" data-toggle="modal" data-target="#myModal" imn></button></li>
            <li class="dropdown">
              <a href="#" class="welcome-name-btn dropdown-toggle" data-toggle="dropdown"> 
                Welcome <?php echo $userData['name']?>
              </a>
              <ul class="dropdown-menu">
                <li>
                    <?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'));?>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="notify-btn dropdown-toggle notifications-btn" data-toggle="dropdown">
                <?php if ($notificationsCount > 0){ 
                  echo "<span class=\"notify-count badge badge-important badge-notifications\">$notificationsCount</span>";
                  }
                ?>
              </a>
              <div id="notifications-menu" class="notifications-menu dropdown-menu list-group"></div>
            </li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('newideaform'); ?>
    </div> <!-- /container -->
</body>
</html>