
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
<?php echo $this->Form->button('Export an Idea') ?>


<?php echo $this->Form->end(); ?>

<div class="inline-block">
<button class="filter" data-filter="Open InProgress Matched">All</button>
<button class="filter" data-filter="Open">Open</button>
<button class="filter" data-filter="InProgress">In Progress</button>
<button class="filter" data-filter="Matched">Matched</button>
</div>

<div class="inline-block">
<button class="sort" data-sort="data-name" data-order="desc">name desc</button>
<button class="sort" data-sort="data-name" data-order="asc">name asc</button>
<button class="sort" data-sort="data-id" data-order="desc">id desc</button>
<button class="sort" data-sort="data-id" data-order="asc">id asc</button>
<button class="sort" data-sort="default" data-order="asc">default</button>
<button class="sort" data-sort="random">random</button>
</div>

<br>

<?php echo $this->element('ideapage', array("ideas" => $ideas)); ?>