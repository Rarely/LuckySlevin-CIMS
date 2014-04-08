<!-- File: /app/View/Categories/view.ctp -->
<?php
    echo $this->Html->script('categories.js');
    echo $this->Html->css('categories.css');
?>

<div class="row well categories-well">
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
                <?php if ($value['specified'] == 0) { ?>
                    <tr data-id="<?php echo $value['id']; ?>" data-name="<?php echo h($value['name']); ?>">
                        <td class="value-name"><?php echo h($value['name']); ?></td>
                        <td>
                         	<div class="btn-edit-value admin-btn admin-btn-sm admin-btn-edit" data-toggle="tooltip" title="Edit"></div>
                            <div class="btn-delete-value admin-btn admin-btn-sm admin-btn-delete" data-toggle="tooltip" title="Delete"></div>
                        </td>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>