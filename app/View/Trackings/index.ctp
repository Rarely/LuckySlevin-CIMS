<!-- File: /app/View/Tracking/index.ctp -->

<h1>Currently Tracked Ideas</h1>
<table class="table">
    <tr>
        <th>User ID</th>
        <th>Idea ID</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($trackings as $tracking): ?>
    <tr>
        <td><?php echo $tracking['Tracking']['userid']; ?></td>

        <td><?php echo $tracking['Tracking']['ideaid']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($tracking); ?>
</table>