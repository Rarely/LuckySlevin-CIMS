
<div class="ideablock btn btn-primary btn-lg" 
      <?php 
          foreach($idea['Idea_Value'] as $value) {
                echo 'category-' . $value['Value']['categoryid'] . '-' . $value['Value']['id'] . ' ';
            }
      ?>
      <?php echo "mix user-" . $idea['Idea']['userid'] . "\"" ?>
      <?php echo "data-id=\"" . $idea['Idea']['id'] . "\"" ?>
      <?php echo "data-user=\"" . $idea['Idea']['userid'] . "\"" ?>
      onclick="Ajax.Idea.showIdea(<?php echo $idea['Idea']['id']?>);return false;" 
      <?php echo "data-updated=\"" . $idea['Idea']['updated'] . "\"" ?> 
>
    <div class="row">
        <div class="title-heading">
            <div class="title-text-wrapper">
                <?php echo $idea['Idea']['name']; ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="description-text-wrapper">
            <div class="description-heading">
                <?php echo $idea['Idea']['description']; ?>
            </div>
        </div>
    </div>  

    <div class="row">
        <div class="status-heading">
            <?php foreach($idea['Idea_Value'] as $value) {
                if ($value['Value']['categoryid'] == $StatusCategoryID){
                    echo $value['Value']['name'];
                    break;
                }
            }?>
        </div>
    </div>
    <div class="row">  
        <div class="col-md-6">
            <div class="owner-heading">
                <?php echo $idea['Users']['name']; ?>
             </div>
        </div>              
        <div class="col-md-6">
            <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>
        </div>
    </div>
</div>

