<!-- File: /app/View/Categories/index.ctp -->

<h1>Categories</h1>
<?php echo $this->Html->link(
    'Create Category',
    array('controller' => 'categories', 'action' => 'add')
); ?>
<table class="table">
    <tr>
        <th>Category Name</th>
        <th>Values</th>
    </tr>
    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $this->Html->link($category['Category']['name'],
array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
        <td> 
            <ul>
                <?php foreach ($category['Values'] as $value): ?>
                    <li><?php echo $value['name']; ?></li>
                <?php endforeach;?>
                <?php unset($value); ?>
            </ul>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($category); ?>
</table>