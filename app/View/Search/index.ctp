
<?php echo $this->Form->create('Search', array(
    'url' => array('controller' => 'search', 'action' => 'index'),
    'inputDefaults' => array(
        'div' => 'form-group',
        'wrapInput' => false,
        'class' => 'form-control'
    ),
    'class' => 'well'
)); ?>
    <fieldset>
        <h2>Search</h2>
        <?php echo $this->Form->input('q', array(
            'label' => '',
            'placeholder' => 'Search...',
            'after' => '<span class="help-block">Search by Idea name.</span>'
        )); ?>
        <?php echo $this->Form->submit('Submit', array(
            'div' => 'form-group',
            'class' => 'btn btn-primary'
        )); ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
<div id="ideacontainer">
<?php echo "Results for \"" . $query . "\""?>
    <?php foreach ($ideas as $idea): ?>
        <?php echo $this->element('smallidea', array("idea" => $idea)); ?>
    <?php endforeach; ?>
    <?php unset($idea); ?>
</div>