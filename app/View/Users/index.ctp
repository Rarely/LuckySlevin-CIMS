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
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['name'],
array('controller' => 'users', 'action' => 'view', $user['User']['id'])); ?>
        </td>
        <td><?php echo $user['User']['email']; ?></td>
        <td><?php echo count($user['Notifications']);?></td>
        <td><?php echo count($user['Trackings']); ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($user); ?>
</table>