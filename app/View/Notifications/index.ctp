<!-- File: /app/View/Notification/index.ctp -->

<h1>Notifications</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Message</th>
        <th>Created</th>
        <th>Idea ID</th>
        <th>User ID</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($notifications as $notification): ?>
    <tr>
        <td><?php echo $notification['Notification']['id']; ?></td>

        <td><?php echo $notification['Notification']['message']; ?></td>

        <td><?php echo $notification['Notification']['created']; ?></td>

        <td><?php echo $notification['Notification']['ideaid']; ?></td>

        <td><?php echo $notification['Notification']['userid']; ?></td>


    </tr>
    <?php endforeach; ?>
    <?php unset($tracking); ?>
</table>