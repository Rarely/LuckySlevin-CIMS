<!-- File: /app/View/Notification/index.ctp -->
<table class="table">
    <tr>
        <th>Message</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($notifications as $notification): ?>
    <tr>
        <td><?php echo $notification['Notification']['message']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($tracking); ?>
</table>