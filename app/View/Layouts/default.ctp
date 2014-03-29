<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $title_for_layout?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="mobile-web-app-capable" content="yes" />
<link rel="apple-touch-icon" href="img/appicon.png"/>
<link rel="shortcut icon" sizes="120x120" href="img/appicon.png" />

<link rel="shortcut icon" href="img/appicon.png" type="image/x-icon">
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
echo $this->Html->script('bootstrap-datepicker.js');

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
echo $this->Html->css('datepicker.css');

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
    <div id="heading-colour" class="navbar navbar-fixed-top" role="navigation">
      <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed nav-collapse-button" data-toggle="collapse" data-target=".navbar-collapse">

            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav nav-font">
            <li>
                <?php echo $this->Html->link('Home', 
                                              array('controller'=>'ideas', 'action'=>'index'),
                                              array('class' =>'heading-text-color'));?>
            </li>
            <li class = "border-line">
                <?php echo $this->Html->link('Search', 
                                              array('controller'=>'search', 'action'=>'index'),
                                              array('class' =>'heading-text-color'));?></li>
            <li>
                <?php echo $this->Html->link('My Page', 
                                              array('controller'=>'trackings', 'action'=>'index'),
                                              array('class' =>'heading-text-color'));?>
            </li>
            <?php if ($userData['role'] == 'admin') { ?>
                <li>
                    <div class ="btn-group">
                      <button type="button" class = "management-btn btn nav-font dropdown-toggle nav-btn" data-toggle="dropdown">
                        Management
                        <span class ="caret"></span>
                        <span class ="sr-only">Management</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                            <li>
                                <?php echo $this->Html->link('User Management',
                                                             array('controller'=>'users', 'action'=>'index'),
                                                             array('class' =>'heading-text-color'));?>
                            </li>   
                            <li>
                                <?php echo $this->Html->link('Category Management', 
                                                              array('controller'=>'categories', 'action'=>'index'),
                                                              array('class' =>'heading-text-color'));?>
                            </li>
                            <li>
                                <?php echo $this->Html->link('Idea Management',
                                                              array('controller'=>'search', 'action'=>'index'),
                                                              array('class' =>'heading-text-color'));?>
                            </li>
                        </ul>
                    </div>
                </li>       
            <?php } ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li>
              <button type="button" class =" btn idea-add-btn nav-btn" id="btn-add-idea" data-toggle="modal" data-target="#myModal">
                 <img src ="/img/addideainverse.png" class ="add-btn" alt="" />
                 Add Idea
              </button>
              
            </li>
            <li class="dropdown border-line nav-btn">
              <a href="#" class="welcome-name-btn dropdown-toggle heading-text-color" data-toggle="dropdown"> 
                Welcome <?php echo h($userData['name']); ?>
              </a>
              <ul class="dropdown-menu">
                    <li>
                        <?php echo $this->Html->link('Logout', 
                                                       array('controller'=>'users', 'action'=>'logout'));?>
                    </li>
              </ul>
            </li>
            <li class="dropdown notifications-btn">
              <a href="#" class="notify-btn dropdown-toggle " data-toggle="dropdown">
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