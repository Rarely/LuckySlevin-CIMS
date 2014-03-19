<!-- File: /app/View/Users/index.ctp -->
<?php echo $this->Html->css('users.css'); ?>

<div class="well users-well row">
<div class="inline-block"><h1>Users</h1></div>
<?php echo $this->Html->link("",
    array('controller' => 'users', 'action' => 'add'),
    array('class' =>'admin-btn admin-btn-md admin-btn-add pull-right inline-block', 'escape' => FALSE, 'style' => 'margin-right: 110px;')
); ?>


<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Notifications</th>
        <th>Trackings</th>
        <th>Actions</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>
    <?php $userNotificationsCount = 0; ?>
    <?php foreach ($user['Notifications'] as $notification) {
        if ($notification['isread'] == false) {
            $userNotificationsCount++;
        }
    } ?>
    <tr data-id=<?php echo $user['User']['id'];?>>
        <td><?php echo $user['User']['id']; ?></td>
        <td><?php echo $user['User']['name'] ?></td>
        <td><?php echo $user['User']['username']; ?></td>
        <td><?php echo $userNotificationsCount; ?></td>
        <td><?php echo count($user['Trackings']); ?></td>
        <td> 
            <div class="btn-delete-user admin-btn admin-btn-sm admin-btn-delete"></div>
            <?php echo $this->Html->link("",
                array('controller' => 'users','action' => 'edit', $user['User']['id'])
                ,array('class' =>'admin-btn admin-btn-sm admin-btn-edit', 'escape' => FALSE)
            );?>
            </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>
</div>
