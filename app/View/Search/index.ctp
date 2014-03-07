
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
                        'placeholder' => 'Search by Idea name...',
                    )); ?>
        </div>
        <div class="row">
            <div class="col-md-2">   
                    <?php echo $this->Form->submit('Submit', array(
                        'div' => 'form-group',
                        'class' => 'btn btn-primary'
                    )); ?>
            </div>
            <?php echo $this->Form->end(); ?>
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
        <?php $cat = 1; ?>

        <div class="row">

        <div class="col-md-6">
            <input type='' class="user_filter" id='e18' placeholder='Owner' style='width:100%' />
        </div>

        <?php foreach ($categories as $category) { ?>
            <?php if ($cat % 2 == 0) { ?>
                <div class="row">
            <?php } ?>
            <?php $cat ++ ?>
              <div class="col-md-6">
                  <!--<label for="categoryDescription"><?php echo $category['Category']['name'] ?></label>-->
                  <input type='' class="cat" id='tags' name="data[Category][<?php echo $category['Category']['id']; ?>]"
                  <?php if ($category['Category']['multiselect'] == true) { echo 'multiple="true"'; } ?>
                  <?php if ($category['Category']['specifiable'] == true) { echo 'specifiable="true"'; } ?>
                  <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
                  <?php echo 'placeholder="' . $category['Category']['name'] .'"' ?>
                   style='width:100%' />
                  <br />
              </div>
            <?php if ($cat % 2 == 0) { ?>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<?php echo $this->element('ideapage', array("ideas" => $ideas)); ?>
