<!-- File: /app/View/Users/index.ctp -->

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