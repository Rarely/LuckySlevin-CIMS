
<?php
    echo $this->Html->script('tinymce/tinymce.min.js');
    echo $this->Html->script('help.js');
?>

<div class="row">
<h1>New page</h1>
<?php
echo $this->Form->create('Help');
echo $this->Form->input('name', array('class' => 'form-control'));
echo $this->Form->input('help_content', array('rows' => '3', 'class' => 'help_edit', 'label' => ''));
echo $this->Form->input('admin', array('label' => 'Admin only page'));
echo $this->Form->end('Save', array('class' => 'btn btn-primary'));
?>
</div>

