
<div 
      <?php echo "class= \"ideablock btn btn-primary btn-lg " ?>

      <?php 
          foreach($idea['Idea_Value'] as $value) {
                echo 'category-' . $value['Value']['categoryid'] . '-' . $value['Value']['id'] . ' ';
            }
      ?>
      <?php echo "mix user-" . $idea['Idea']['userid'] . "\"" ?>
      <?php echo "data-id=\"" . $idea['Idea']['id'] . "\"" ?>
      <?php echo "data-user=\"" . $idea['Idea']['userid'] . "\"" ?>
              <?php echo "data-name=\"" . htmlspecialchars($idea['Idea']['name']) . "\"" ?>
        <?php echo "data-community=\"" . htmlspecialchars($idea['Idea']['community_partner']) . "\"" ?>
        <?php echo "data-created=\"" . $idea['Idea']['created'] . "\"" ?>
        <?php echo "data-updated=\"" . $idea['Idea']['updated'] . "\"" ?>
        <?php echo "data-start=\"" . $idea['Idea']['start_date'] . "\"" ?>
        <?php echo "data-end=\"" . $idea['Idea']['end_date'] . "\"" ?>
      onclick="Ajax.Idea.showIdea(<?php echo $idea['Idea']['id']?>);return false;" 
>
    <div class="row">
        <div class="title-text-wrapper title-heading">
            <?php echo htmlspecialchars($idea['Idea']['name']); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="description-text-wrapper description-heading">
            <?php echo htmlspecialchars($idea['Idea']['description']); ?>
        </div>
    </div>  


    <div class="row">
        <div class="status-text-wrapper status-heading">
            <?php foreach($idea['Idea_Value'] as $value) {
                if ($value['Value']['categoryid'] == $StatusCategoryID){
                    echo htmlspecialchars($value['Value']['name']);
                    break;
                }
            }?>
        </div>
    </div>
    <div class="row">  
        <div class="col-md-6">
            <div class="owner-text-wrapper owner-heading">
                <?php echo htmlspecialchars($idea['Users']['name']); ?>
             </div>
        </div>              
        <div class="col-md-6">
            <?php echo $this->element('ideaactions', array("idea" => $idea)); ?>
        </div>
    </div>
</div>

