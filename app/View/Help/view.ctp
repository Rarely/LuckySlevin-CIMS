
<?php
    echo $this->Html->css('help.css');
?>

<div class="row well help-well">
    <div class="row">
        <div class="inline-block"><h1>Help Page</h1></div>
        <?php echo $this->Html->link("", 
              array('controller' => 'help', 'action' => 'edit', $help['Help']['id']),
              array('class' =>'pull-right btn-edit-value admin-btn admin-btn-md admin-btn-edit')
             ); ?>

        <hr style="width:100%; height: 5px;">
    </div>
    <div class="row content">
        <div id="help-content"><?php echo $help['Help']['help_content'] ?></div>
    </div>
</div>