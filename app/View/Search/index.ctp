
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
    <!-- EXPORT -->
    <div id="btn-export" class="btn btn-success">Export</div>
    <div id="btn-cancel-csv" class="btn btn-default">Cancel</div>
    <span id="export-help">Please click the title of the ideas you would like to export below</span>
    <div id="btn-save-csv" class="btn btn-success">Save to File</div>
    
    <!-- DELETE -->
    <div id="btn-delete" class="btn btn-danger">Delete</div>
    <div id="btn-cancel-delete" class="btn btn-default">Cancel</div>
    <div id="btn-delete-confirm" class="btn btn-primary">Confirm</div>


<?php echo $this->Form->end(); ?>
<div class="inline-block">
<button class="filter" data-filter="1">1</button>
<button class="filter" data-filter="2">2</button>
<button class="filter" data-filter="3">3</button>
</div>

<div class="inline-block">
<button class="sort" data-sort="data-name" data-order="desc">name desc</button>
<button class="sort" data-sort="data-name" data-order="asc">name asc</button>
<button class="sort" data-sort="data-id" data-order="desc">id desc</button>
<button class="sort" data-sort="data-id" data-order="asc">id asc</button>
<button class="sort" data-sort="default" data-order="asc">default</button>
<button class="sort" data-sort="random">random</button>
</div>


<div id="filters">
<?php echo $this->Form->input('share', array(
               'class' => 'user_filter'
               ,'id' => 'e18'
             )); ?>
</div>
<br>



<?php echo $this->element('ideapage', array("ideas" => $ideas)); ?>