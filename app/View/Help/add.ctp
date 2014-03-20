
<?php
    echo $this->Html->script('tinymce/tinymce.min.js');
    echo $this->Html->script('help.js');
?>

<div class="row">
<h1>New page</h1>
<?php
echo $this->Form->create('Help');
echo $this->Form->input('name');
echo $this->Form->input('help_content', array('rows' => '3', 'class' => 'help_edit'));
echo $this->Form->end('Save');
?>
</div>

