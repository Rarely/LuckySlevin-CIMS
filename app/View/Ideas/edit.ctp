<?php echo $this->Html->script('editidea.js'); ?>
<div class="row well well-top-margin">
<h1> Edit an Idea </h1>

<?php echo $this->Form->create('Idea', array(
  'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
  ),
  'id' => 'edit-idea-form'
)); ?>

    <fieldset>
      <?php echo $this->Form->input('name', array(
        'label' => 'name',
        'value' => $idea['Idea']['name'],
      )); ?>
      
      <?php echo $this->Form->input('description', array(
        'label' => 'description (max 1000)',
        'maxlength'   => '1000',
        'value' => $idea['Idea']['description'],
      )); ?>

      <?php foreach ($categories as $category) { ?>
        <label for="categoryDescription"><?php echo $category['Category']['name'] ?></label>
        <input type='hidden' class="cat" id='tags'
        name="data[Category][<?php echo $category['Category']['id']; ?>]"
        <?php if ($category['Category']['multiselect'] == true) { echo 'multiple="true"'; } ?>
        <?php if ($category['Category']['specifiable'] == true) { echo 'specifiable="true"'; } ?>
        <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
        <?php 
          echo 'value=" "'; //IMPORTANT BUG FIX
          echo 'init-value=\'';
          $json_values = array();
          foreach ($values as $value) {
            if (isset($value) && $value != '' && ($value ['Value']['categoryid'] == $category['Category']['id'])) {
              if (isset($value['Value']['id']) && $value['Value']['id'] != '' && isset($value['Value']['name']) && $value['Value']['name'] != '') {
                array_push($json_values, array('id'=> $value['Value']['id'], 'text' => $value['Value']['name']));
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
      <input type="hidden" name="data[Idea][userid]" value=" " initvalue='<?php echo json_encode(array('id' => $idea['Users']['id'], 'text' => $idea['Users']['name'] . '(' . $idea['Users']['username'] . ')')); ?>' class="owner-select" />
      <br />

      <?php echo $this->Form->submit('Save', array(
        'div' => 'form-group',
        'class' => 'btn btn-primary'
      )); ?>
  </fieldset>
<?php echo $this->Form->end(); ?>
</div>
