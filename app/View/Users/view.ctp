<!-- File: /app/View/Users/view.ctp -->
<?php echo $this->Html->css('users.css'); ?>

<div class="row well users-well">
    <h1><?php echo h($user['User']['name']); ?></h1>

    <p><small>Created: <?php echo $user['User']['username']; ?></small></p>

    <p><?php echo h($user['User']['role']); ?></p>
</div>