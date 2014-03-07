
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
            'placeholder' => 'Search by Idea name...',
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

<div id="filters">
<?php echo $this->Form->input('share', array(
               'class' => 'user_filter'
               ,'id' => 'e18'
             )); ?>
</div>
<br>

<?php foreach ($categories as $category) { ?>
  <label for="categoryDescription"><?php echo $category['Category']['name'] ?></label>
  <input type='' class="cat" id='tags' name="data[Category][<?php echo $category['Category']['id']; ?>]"
  <?php if ($category['Category']['multiselect'] == true) { echo 'multiple="true"'; } ?>
  <?php if ($category['Category']['specifiable'] == true) { echo 'specifiable="true"'; } ?>
  <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
   style='width:100%' />
  <br />
<?php } ?>


<br>

<?php echo $this->element('ideapage', array("ideas" => $ideas)); ?>