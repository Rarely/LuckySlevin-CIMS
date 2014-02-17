<!-- File: /app/View/Ideas/index.ctp -->

<h1>Ideas</h1>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
        <th>User ID</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($ideas as $idea): ?>
    <tr>
        <td><?php echo $idea['Idea']['id']; ?></td>
        <td><?php echo $idea['Idea']['name']; ?></td>
        <td><?php echo $idea['Idea']['description']; ?></td>
        <td><?php echo $idea['Idea']['status']; ?></td>
        <td><?php echo $idea['Idea']['created']; ?></td>
        <td><?php echo $idea['Idea']['updated']; ?></td>
        <td><?php echo $idea['Idea']['userid']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($idea); ?>
</table>
    <?php foreach ($ideas as $idea): ?>
        <?php echo $this->element('smallidea', array("idea" => $idea)); ?>
    <?php endforeach; ?>
    <?php unset($idea); ?>
