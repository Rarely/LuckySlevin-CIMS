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

//custom css
echo $this->Html->css('bootstrap.min.css');
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
            <li><a href="/">Home</a></li>
            <li><a href="/search">Search</a></li>
            <li><a href="/trackings">Tracking</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="/users">Users</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/notifications">Notifications</a></li>
            <li><a href="#">Messages</a></li>
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