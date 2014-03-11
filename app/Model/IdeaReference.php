<?php 
class IdeaReference extends AppModel {
    public $belongsTo = array(
                            'Idea' => array(
                               'className' => 'Idea'
                               ,'foreignKey' => 'ideaid'
                            ),
                            'Idea' => array(
                               'className' => 'Idea'
                               ,'foreignKey' => 'refers_to'
                            ));
}