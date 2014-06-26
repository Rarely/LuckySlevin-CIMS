<?php echo $this->Html->script('newidea.js'); ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <?php echo $this->Form->create('Idea', array(
          'url' => array('controller' => 'ideas', 'action' => 'add')
          ,'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control')
          ,'id' => 'new-idea-form'
          ,'type' => 'file'
        )); ?>

      <div class="modal-header modal-header-color">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" style="color:white;" id="myModalLabel">Add a New Idea</h2>
      </div>
      <div class="modal-body">
        <fieldset>
            <?php echo $this->Form->input('name', array(
              'label' => 'Idea Name',
              'placeholder' => 'Idea Name',
              'maxlength' => '45'
            )); ?>

            <?php echo $this->Form->input('community_partner', array(
              'label' => 'Community Partner',
              'placeholder' => 'Community Partner'
            )); ?>

            <?php echo $this->Form->input('contact_name', array(
              'label' => 'Contact Name',
              'placeholder' => 'Contact Name',
              'maxlength' => '100',
              'required' => true
            )); ?>

            <?php echo $this->Form->input('contact_email', array(
              'label' => 'Contact Email',
              'placeholder' => 'Contact Email',
              'maxlength' => '100',
              'required' => true
            )); ?>

            <?php echo $this->Form->input('contact_phone', array(
                    'label' => 'Contact Phone',
                    'placeholder' => 'Contact Phone'
                    )); ?>

            <?php echo $this->Form->input('description', array(
              'label' => 'Description (maximum of 1000 characters)',
              'placeholder' => 'Insert a description here',
              'maxlength'   => '1000',
              'required' => true
              )); ?>

            <label>Timeframe</label>  
            (If no dates are selected, timeframe will be displayed as flexible.)
            <table class="table">
              <thead>
                <tr>
                  <th>
                    <a href="#" class="btn-small" id="add-idea-dp1" data-date-format="yyyy-mm-dd" data-date="">Start date</a>
                  </th>
                  <th>
                    <a href="#" class="btn-small" id="add-idea-dp2" data-date-format="yyyy-mm-dd" data-date="">End date</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <input type='hidden' id="add-idea-start-date" name="data[Idea][start_date]" >
                    <div id="add-idea-start-date-text"></div>
                    <a class="btn btn-small" id="clear-new-start-date">Clear</a>
                  </td>
                  <td>
                    <input type='hidden' id="add-idea-end-date" name="data[Idea][end_date]" >
                    <div id="add-idea-end-date-text"></div>
                    <a class="btn btn-small" id="clear-new-end-date">Clear</a>
                  </td>
                </tr>
              </tbody>
            </table>

            <?php foreach ($categories as $category) { ?>
              <label><?php echo h($category['Category']['name']) ?></label>
              <input type='hidden' class="cat" name="data[Category][<?php echo $category['Category']['id']; ?>]"
              <?php if ($category['Category']['multiselect'] == true) { echo 'data-multiple="true"'; } ?>
              <?php if ($category['Category']['specifiable'] == true) { echo 'data-specifiable="true"'; } ?>
              <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
               style='width:100%' />
              <br />
            <?php } ?>

            <label>Owner</label>
            <input type="hidden" name="data[Idea][userid]" value=" " data-initvalue='<?php echo json_encode(array('id' => $userData['id'], 'text' => h($userData['name']) . '(' . h($userData['username']) . ')')); ?>' class="owner-select" />

            <label>Referenced Ideas</label>
            <input type="hidden" class="idea-references" name="data[Idea][references]" value=" " data-multiple="true" />

            <?php echo $this->Form->input('files.', array('type' => 'file', 'multiple'=>'multiple', 'required'=>false)); ?>
          </fieldset>
      </div>
      <div class="modal-footer modal-header-color">
        <div class="btn btn-default" data-dismiss="modal">Cancel</div>
        <input class="btn btn-primary" type="submit" value="Submit" />
      </div>
      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</div>