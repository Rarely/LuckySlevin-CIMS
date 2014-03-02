<?php 
class IdeaValue extends AppModel {
    public $belongsTo = array('Value' => array(
                           'className' => 'Value'
                           ,'foreignKey' => 'valueid'
                        ));
}