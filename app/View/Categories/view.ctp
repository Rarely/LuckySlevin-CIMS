<!-- File: /app/View/Categories/view.ctp -->
<?php echo $this->Html->script('categories.js'); ?>
<?php echo $this->Html->css('categories.css'); ?>

<div class="well row categories-well">
    <h1><?php echo h($category['Category']['name']); ?></h1>
    <?php echo $this->Html->link("<span class=\"glyphicon glyphicon-arrow-left\"></span> Back to Categories",
    array('controller' => 'categories', 'action' => 'index'), array('class'=> 'btn btn-default',
        'escape'=> false)); ?>
    <div id="btn-add-value" class="btn btn-primary">Add Value</div>
    <table class="table table-category" data-id="<?php echo $category['Category']['id']; ?>">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($category['Value'] as $value): ?>
                <tr data-id="<?php echo $value['id']; ?>">
                    <td class="value-name"><?php echo $value['name']; ?></td>
                    <td>
                        <div class="btn-edit-value btn btn-default">Edit</div>
                        <div class="btn-delete-value btn btn-danger">Delete</div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>