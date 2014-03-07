<!-- File: /app/View/Values/index.ctp -->

<h1>Values</h1>
<table class="table">
    <tr>
        <th>Category Name</th>
        <th>Values</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $this->Html->link($category['Category']['name'],
array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($category['Value'] as $value): ?>
                    <tr>
                        <td><?php echo $value['name']; ?></td>
                        <td>
                            <?php echo $this->Html->link(
                                'Delete',
                                array('controller' => 'categories', 'action' => 'delete', $value['id']),
                                array('class'=> 'btn btn-danger')
                            ); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </td>
        <td>
            <?php echo $this->Html->link(
                'Create Value',
                array('controller' => 'categories', 'action' => 'add', $category['Category']['id']),
                array('class'=> 'btn btn-default')
            ); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($category); ?>
</table>