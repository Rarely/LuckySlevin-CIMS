<!-- File: /app/View/Users/login.ctp -->
<div class="col-md-4 col-md-offset-4">
<?php
    echo $this->Html->script('jquery-1.11.0.min.js');
    echo $this->Html->css('bootstrap.css');
    echo $this->Html->script('bootstrap.min.js');
    echo $this->Html->css('login.css');
?>
<?php echo $this->Html->script('editidea.js'); ?>
    <h1> Add an Idea </h1>

<?php echo $this->Form->create('Idea', array(
    'inputDefaults' => array(
    'div' => 'form-group',
    'wrapInput' => false,
    'class' => 'form-control'
    ),
  'class' => 'well'
)); ?>

<fieldset>
    <?php echo $this->Form->input('contact_name', array(
        'label' => 'Contact Name',
        'placeholder' => 'Contact Name',
        'rows'=>1
    )); ?>

    <?php echo $this->Form->input('contact_email', array(
        'label' => 'Contact Email',
        'placeholder' => 'Contact Email',
        'rows'=>1
    )); ?>

    <?php echo $this->Form->input('description', array(
        'label' => 'Description (max 1000)',
        'placeholder' => 'Insert a description here',
        'maxlength'   => '1000',
    )); ?>

    <?php echo $this->Form->submit('Save', array(
        'div' => 'form-group',
        'class' => 'btn btn-primary'
    )); ?>
</fieldset>
<?php echo $this->Form->end(); ?>
</div>