
<?php
    echo $this->Html->script('search.js');
    echo $this->Html->css('jquery-selectable.css');
    echo $this->Html->css('search.css');
?>
<div class="row search-well well">
    <div class="col-md-6">
        <div class="row">
            <?php echo $this->Form->create('Search', array(
                'url' => array('controller' => 'search', 'action'    => 'index'),
                'inputDefaults' => array(
                    'div' => 'form-group',
                    'wrapInput' => false,
                    'class' => 'form-control'
                )
            )); ?>
                <div class="heading">Search</div>
                    <?php echo $this->Form->input('q', array(
                        'label' => '',
                        'placeholder' => 'Search...',
                        'after' => '<span class="help-block">Search by Idea name.</span>'
                    )); ?>
        </div>
        <div class="row">
            <div class="col-md-2">   
                    <?php echo $this->Form->submit('Submit', array(
                        'div' => 'form-group',
                        'class' => 'btn btn-primary'
                    )); ?>
            </div>
            <div class="col-md-2">  
                <!-- EXPORT -->
                <div id="btn-export" class="btn btn-success">Export</div>
                <div id="btn-cancel-csv" class="btn btn-default">Cancel</div>
                <span id="export-help">Please click the title of the ideas you would like to export below</span>
                <div id="btn-save-csv" class="btn btn-success">Save to File</div>
            </div>
            <div class="col-md-2">    
                <!-- DELETE -->
                <div id="btn-delete" class="btn btn-danger">Delete</div>
                <div id="btn-cancel-delete" class="btn btn-default">Cancel</div>
                <div id="btn-delete-confirm" class="btn btn-primary">Confirm</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
    Graeme put filters here
    </div>
</div>

<?php echo $this->Form->end(); ?>
<?php echo $this->element('idealist', array("ideas" => $ideas)); ?>