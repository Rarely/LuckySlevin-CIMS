
<?php
    echo $this->Html->script('search.js');
    echo $this->Html->css('jquery-selectable.css');
?>

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
    <div id="btn-export" class="btn btn-success">Export</div>
    <div id="btn-cancel-csv" class="btn btn-default">Cancel</div>
    <span id="export-help">Please click the title of the ideas you would like to export below</span>
    <div id="btn-save-csv" class="btn btn-success">Save to File</div>

<?php echo $this->Form->end(); ?>
<?php echo $this->element('idealist', array("ideas" => $ideas)); ?>