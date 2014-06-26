<?php echo $this->Html->script('editidea.js'); ?>
<div id="edit-idea-content" class="row well well-top-margin" data-id="<?php echo $idea['Idea']['id']; ?>">
<h1> <?php echo $this->Session->read('page_title'); ?> </h1>
<h3> <?php echo $this->Session->read('page_description'); ?> </h3>

<?php echo $this->Form->create('Idea', array(
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'id' => 'edit-idea-form'
  ,'type' => 'file'
)); ?>

<fieldset>
  <?php echo $this->Form->input('name', array(
    'label' => 'Idea Title',
    'value' => $idea['Idea']['name']
  )); ?>
  <?php echo $this->Form->input('community_partner', array(
    'label' => 'Community Partner',
    'value' => $idea['Idea']['community_partner']
  )); ?>      
  <?php echo $this->Form->input('contact_name',array(
    'label' => 'Contact Name',
    'value' => $idea['Idea']['contact_name'],
    'required' => true

  )); ?>
  <?php echo $this->Form->input('contact_email',array(
    'label' => 'Contact Email',
    'value' => $idea['Idea']['contact_email'],
    'required' => true
  )); ?>
  <?php echo $this->Form->input('contact_phone',array(
    'label' => 'Contact Phone',
    'value' => $idea['Idea']['contact_phone']
  )); ?>
  
  <?php echo $this->Form->input('description', array(
    'label' => 'description (maximum of 1000 characters)',
    'maxlength'   => '1000',
    'value' => $idea['Idea']['description'],
    'required' => true
  )); ?>

  <label>Timeframe</label> 
  (If no dates are selected, timeframe will be displayed as flexible.)
  <table class="table">
    <thead>
      <tr>
        <th>
          <a href="#" class="btn btn-small" id="edit-idea-dp1" data-date-format="yyyy-mm-dd" data-date="<?php echo $idea['Idea']['start_date'];?>">Start Date</a>
        </th>
        <th>
          <a href="#" class="btn btn-small" id="edit-idea-dp2" data-date-format="yyyy-mm-dd" data-date="<?php echo $idea['Idea']['end_date'];?>">End Date</a>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type='hidden' id="edit-idea-start-date" name="data[Idea][start_date]" ><div id="edit-idea-start-date-text"><?php echo $idea['Idea']['start_date'];?></div>
        <a class="btn btn-small" id="clear-start-date">Clear</a></td>
        <td><input type='hidden' id="edit-idea-end-date" name="data[Idea][end_date]" ><div id="edit-idea-end-date-text"><?php echo $idea['Idea']['end_date'];?></div>
        <a class="btn btn-small" id="clear-end-date">Clear</a></td>
      </tr>
    </tbody>
  </table>

  <?php foreach ($categories as $category) { ?>
    <label for="categoryDescription"><?php echo h($category['Category']['name']); ?></label>
    <input type='hidden' class="cat"
    name="data[Category][<?php echo $category['Category']['id']; ?>]"
    <?php if ($category['Category']['multiselect'] == true) { echo 'data-multiple="true"'; } ?>
    <?php if ($category['Category']['specifiable'] == true) { echo 'data-specifiable="true"'; } ?>
    <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
    <?php 
      echo 'value=" "'; //IMPORTANT BUG FIX
      echo 'init-value=\'';
      $json_values = array();
      foreach ($values as $value) {
        if (isset($value) && $value != '' && ($value ['Value']['categoryid'] == $category['Category']['id'])) {
          if (isset($value['Value']['id']) && $value['Value']['id'] != '' && isset($value['Value']['name']) && $value['Value']['name'] != '') {
            array_push($json_values, array('id'=> $value['Value']['id'], 'text' => h($value['Value']['name'])));
          }
        }
      }
      if (count($json_values) == 1) {
        $json_values = $json_values[0];
      } else if (count($json_values) == 0) {
        $json_values = null;
      }
      echo json_encode($json_values);
      echo '\''; 
    ?>
     style='width:100%' />
    <br />
  <?php } ?>

  <label for="owner">Owner</label>
  <input type="hidden" name="data[Idea][userid]" value=" " data-initvalue='<?php echo json_encode(array('id' => $idea['Users']['id'], 'text' => h($idea['Users']['name']) . '(' . h($idea['Users']['username']) . ')')); ?>' class="owner-select" />
  <label for="data[Idea][references]">Referenced Ideas</label>
  <?php
    $references = array();
    foreach($idea['References'] as $ref) {
      array_push($references, array('id' => $ref['id'], 'text'=> h($ref['name'])));
    }

    if (count($references) == 1) {
      $references = $references[0];
    } else if (count($references) == 0) {
      $references = null;
    }
    ?>
  <input type="hidden" class="idea-references" name="data[Idea][references]" value=" " data-initvalue='<?php echo json_encode($references); ?>' data-multiple="true" />
  <label>Existing Files</label>
  <ul id="filelist">
  <?php if (!empty($files)) { ?>
    <?php foreach ($files as $file) { ?>
      <li data-id="<?php echo $file['IdeaFile']['id']?>"><?php echo $file['IdeaFile']['filename']; ?><?php echo $this->Html->link(
        ' &times; Remove'
        ,'javascript:Ajax.Idea.deleteIdeaFile(' . $file['IdeaFile']['id'] . ');'
        ,array('escape' => false, 'class' => 'btn btn-close pull-right')
        ,"Are you sure you want to remove this file?"); ?></li>
    <?php } ?>
  <?php } else { ?>
    <li>There are no files</li>
  <?php } ?>  
  </ul>
  <?php echo $this->Form->input('files.', array('type' => 'file', 'multiple'=>'multiple', 'required'=>false)); ?>
  <br />

  <?php echo $this->Form->submit('Save', array(
    'div' => 'form-group save-btn',
    'class' => 'btn btn-primary'
  )); ?>
    
</fieldset>
<?php echo $this->Form->end(); ?>
</div>
