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

//custom css
echo $this->Html->css('bootstrap.min.css');
echo $this->Html->script('boostrap.min.js');
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
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">Search</a></li>
            <li><a href="#contact">Tracking</a></li>
            <li><a href="#contact">Analytics</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Notifications</a></li>
            <li><a href="#">Messages</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h1>welcome to CIMS</h1>
        <p>To get started, </p>
        <p>
          <a class="btn btn-lg btn-primary" href="#" role="button">See Ideas &raquo;</a>
        </p>
      </div>
      <?php echo $this->fetch('content'); ?>

    </div> <!-- /container -->

</body>
</html>