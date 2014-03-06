<?php 
class IdeaValue extends AppModel {
    public $belongsTo = array(
                            'Value' => array(
                               'className' => 'Value'
                               ,'foreignKey' => 'valueid'
                            ),
                            'Idea' => array(
                               'className' => 'Idea'
                               ,'foreignKey' => 'ideaid'
                            ));
}