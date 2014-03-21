<!-- File: /app/View/Help/index.ctp -->
<?php
    echo $this->Html->script('tinymce/tinymce.min.js');
    echo $this->Html->script('help.js');
    echo $this->Html->css('help.css');
?>

<div class="row">
    <div class="col-md-9">
        <div class="row well help-well">
            <?php $first = true ?>
            <?php foreach ($helps as $help): ?>
                <?php echo "<div class=\"help-content\" id=\"help-" . $help["Help"]["id"] . "\""; ?>
                <?php if($helpToDisplay == null){ ?>
                    <?php if(!$first) echo " style='display:none;'"; ?>>
                    <?php $first = false; ?>
                <?php }else{ ?>
                    <?php if($help["Help"]["id"] != $helpToDisplay) echo " style='display:none;'"; ?>>
                <?php } ?>
                <?php if ($userData['role'] == 'admin') { ?>
                    <div class="row">
                        <?php echo $this->Html->link("", 
                          array('controller' => 'help', 'action' => 'edit', $help['Help']['id']),
                          array('class' =>'pull-right btn-edit-value admin-btn admin-btn-sm admin-btn-edit')); ?>
                        <?php echo $this->Form->postLink("",
                            array('controller' => 'help', 'action' => 'delete', $help['Help']['id']),
                            array('class' => 'pull-right admin-btn admin-btn-sm admin-btn-delete', 'confirm' => 'Are you sure?')); ?>
                    </div>
                <?php } ?>
                    <div class="row">    
                        <?php echo $help["Help"]["help_content"]; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-md-3">
        <div class=" well help-well">
            <h1>Help contents</h1><br>
            <?php foreach ($helps as $help): ?>
                <div class="row">
                    <a class="help-link"
                    <?php echo "data-id=" . $help['Help']['id']; ?>>
                    <?php echo $help["Help"]["name"]; ?></a>
                </div>
            <?php endforeach; ?>
            <?php if ($userData['role'] == 'admin') { 
                echo '<br>' . $this->Html->link('Create new help page', 
                    array('controller'=>'help', 'action'=>'add'));
            } ?>
        </div>
    </div>
</div>