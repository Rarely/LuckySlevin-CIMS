<?php 
class IdeaFile extends AppModel {
    public $belongsTo = array(
      'Idea' => array(
         'className' => 'Idea'
         ,'foreignKey' => 'ideaid'
    ));
}
