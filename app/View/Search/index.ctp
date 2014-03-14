
<?php
    echo $this->Html->script('search.js');
    echo $this->Html->css('jquery-selectable.css');
    echo $this->Html->css('search.css');
    echo $this->Html->script('jquery.mixitup.min.js');
    echo $this->Html->script('filter.js');
?>

<div class="row">
    <div class="col-md-9">
        <div class="row search-well well">

                <div class="row">
                    <?php echo $this->Form->create('Search', array(
                        'url' => array('controller' => 'search', 'action'    => 'index'),
                        'inputDefaults' => array(
                            'div' => 'form-group',
                            'wrapInput' => false,
                            'class' => 'form-control'
                        )
                    )); ?>
                        <h1>Search</h1>
                            <?php echo $this->Form->input('q', array(
                                'label' => '',
                                'placeholder' => 'Search by Idea name...',
                            )); ?>
                </div>
                <div class="row">
                    <div class="inline-block">
                        <?php echo $this->Form->submit('Submit', array(
                            'div' => 'form-group',
                            'class' => 'btn btn-primary'
                        )); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <?php if (isset($userData['role']) && $userData['role'] === 'admin') { ?>
                    <!-- EXPORT -->
                    <div id="btn-export" class="btn btn-success float-right inline-block">Export</div>
                    <!-- DELETE -->
                    <div id="btn-delete" class="btn btn-danger float-right inline-block">Delete</div>
                    <?php } ?>

                </div>
                    <div class="row">
                        <div id="btn-cancel-csv" class="btn btn-default">Cancel</div>
                        <span id="export-help">Please click the title of the ideas you would like to export below</span>
                        <div id="btn-save-csv" class="btn btn-success">Save to File</div>

                        <div id="btn-cancel-delete" class="btn btn-default">Cancel</div>
                        <div id="btn-delete-confirm" class="btn btn-primary">Confirm</div>
                </div>
        </div>
        <div class="row">
        <?php if(count($ideas) < 1) { ?>
                 <div class="ideacontainer well empty-list"><h1 class="text-center">There are no ideas matching your current search criteria</h1></div>
            <?php } else {
                 echo $this->element('ideapage', array("ideas" => $ideas)); 
                } ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class="well filter-well">
            <div class="row">
                <h1>Filters</h1>
            </div>
            <div class="row filter-controls">
            <!-- FILTER -->
                <div class="row category-row">
                    <input type='' class="user_filter" id='e18' placeholder='Owner' style='width:100%' />
                </div>
                <?php foreach ($categories as $category) { ?>
                    <div class="row category-row">
                      <input type='' class="cat" id='tags' name="data[Category][<?php echo $category['Category']['id']; ?>]" multiple="true"
                      <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
                      <?php echo 'placeholder="' . $category['Category']['name'] .'"' ?>
                       style='width:100%' />
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <h1>Sort</h1>
            </div>
             <div class="row sort-controls">
                <!-- SORTING -->
                <div class="row">
                    <input type='' class="sort_by" id='tags' placeholder='Sort by' style='width:100%' />
                </div>
                <div class="row">
                     <select id="sort_order" id='tags' placeholder='Order by' style='width:100%'>
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>