<?php echo $this->Html->script('newidea.js'); ?>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-color">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2 class="modal-title" style="color:white;" id="myModalLabel">Add a New Idea</h2>
      </div>
      <div class="modal-body">
        <?php echo $this->Form->create('Idea', array(
          'url' => array('controller' => 'ideas', 'action' => 'add'),
          'inputDefaults' => array(
            'div' => 'form-group',
            'wrapInput' => false,
            'class' => 'form-control'
          ),
          'class' => 'well',
          'id' => 'new-idea-form'
        )); ?>
          <fieldset>
            <?php echo $this->Form->input('name', array(
              'label' => 'Idea Name',
              'placeholder' => 'Idea Name',
              'maxlength' => '45'
            )); ?>

            <?php echo $this->Form->input('community_partner', array(
              'label' => 'Community Partner',
              'placeholder' => 'Community Partner',
              'rows'=>1
            )); ?>

            <?php echo $this->Form->input('contact_name', array(
              'label' => 'Contact Name',
              'placeholder' => 'Contact Name',
              'rows'=>1,
              'maxlength' => '100'
            )); ?>

            <?php echo $this->Form->input('contact_email', array(
              'label' => 'Contact Email',
              'placeholder' => 'Contact Email',
              'rows'=>1,
              'maxlength' => '100'
            )); ?>

            <?php echo $this->Form->input('description', array(
              'label' => 'Description (max 1000)',
              'placeholder' => 'Insert a description here',
              'maxlength'   => '1000',
              )); ?>

            <label>Timeframe</label>  
            <table class="table">
              <thead>
                <tr>
                  <th>
                    <a href="#" class="btn-small" id="add-idea-dp1" data-date-format="yyyy-mm-dd" data-date="2014-02-25">Start date</a>
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
                  </td>
                  <td>
                    <input type='hidden' id="add-idea-end-date" name="data[Idea][end_date]" >
                    <div id="add-idea-end-date-text"></div>
                  </td>
                </tr>
              </tbody>
            </table>

            <?php foreach ($categories as $category) { ?>
              <label for="categoryDescription"><?php echo $category['Category']['name'] ?></label>
              <input type='hidden' class="cat" id='tags' name="data[Category][<?php echo $category['Category']['id']; ?>]"
              <?php if ($category['Category']['multiselect'] == true) { echo 'multiple="true"'; } ?>
              <?php if ($category['Category']['specifiable'] == true) { echo 'specifiable="true"'; } ?>
              <?php echo 'data-id="' . $category['Category']['id'] .'"'; ?>
               style='width:100%' />
              <br />
            <?php } ?>

            <label for="owner">Owner</label>
            <input type="hidden" name="data[Idea][userid]" value=" " initvalue='<?php echo json_encode(array('id' => $userData['id'], 'text' => $userData['name'] . '(' . $userData['username'] . ')')); ?>' class="owner-select" />

            <label for="data[Idea][references]">Referenced Ideas</label>
            <input type="hidden" class="idea-references" name="data[Idea][references]" value=" " multiple="true" />
          </fieldset>

      </div>
      <div class="modal-footer modal-header-color">
        <input class="btn btn-primary" type="submit" value="Submit" />
        <div class="btn btn-default" data-dismiss="modal">Cancel</div>
      </div>
    </div>
  </div>
</div>