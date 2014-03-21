<!-- File: /app/View/Help/index.ctp -->
<?php
    echo $this->Html->script('tinymce/tinymce.min.js');
    echo $this->Html->script('help.js');
    echo $this->Html->css('help.css');
?>


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
                      array('class' =>'pull-right btn-edit-value admin-btn admin-btn-md admin-btn-edit')
                     ); ?>
                     <div class="pull-right admin-btn admin-btn-md admin-btn-delete">
                    <?php echo $this->Form->postLink('DAMN IT',
                        array('action' => 'delete', $help['Help']['id']),
                        array('confirm' => 'Are you sure?'));
                    ?>
                    </div>
                </div>
            <?php } ?>
                <div class="row">    
                    <?php echo $help["Help"]["help_content"]; ?>
                </div>
            <?php echo "</div>" ?>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-md-3 well help-well">
    <?php foreach ($helps as $help): ?>
        <div class="row">
            <a class="help-link"
            <?php echo "data-id=" . $help['Help']['id']; ?>>
            <?php echo $help["Help"]["name"]; ?></a>
        </div>
    <?php endforeach; ?>
    <?php if ($userData['role'] == 'admin') { 
        echo $this->Html->link('New help page', 
            array('controller'=>'help', 'action'=>'add'));
    } ?>
</div>

