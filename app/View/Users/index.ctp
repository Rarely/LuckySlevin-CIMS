<!-- File: /app/View/Users/index.ctp -->

<h1>Users</h1>
<?php echo $this->Html->link(
    'Create User',
    array('controller' => 'users', 'action' => 'add')
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
    <tr data-id=<?php echo $user['User']['id'];?>>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['name'],
array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
        </td>
        <td><?php echo $user['User']['username']; ?></td>
        <td><?php echo count($user['Notifications']);?></td>
        <td><?php echo count($user['Trackings']); ?></td>
        <td> 
            <div class="admin-btn btn btn-danger btn-delete-user">
                <img src="img/delete.png" height="20px"/>
            </div>
            <?php echo $this->Html->link("<img src=\"img/edit.png\" height=\"20px\" width=\"20px\"/>",array('controller' => 'users', 
                'action' => 'edit', 
                $user['User']['id'])
            , array('class' =>'admin-btn btn btn-default', 'escape' => FALSE)
            );?>
            </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>