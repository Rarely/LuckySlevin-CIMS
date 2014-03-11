<!-- File: /app/View/Categories/index.ctp -->
<?php echo $this->Html->script('categories.js'); ?>
<?php echo $this->Html->css('categories.css'); ?>
<div class="row well categories-well">
<h1>Categories</h1>
<table class="table">
    <thead>
        <tr>
            <th>Category Name</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
    <tr>
        <td><?php echo $this->Html->link($category['Category']['name'],
array('controller' => 'categories', 'action' => 'view', $category['Category']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <?php unset($category); ?>
</table>
</div>