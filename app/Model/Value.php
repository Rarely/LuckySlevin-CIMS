<?php
class Value extends AppModel {
    public $hasMany = array('Idea_Value' => array(
                           'className' => 'IdeaValue'
                           ,'foreignKey' => 'valueid'
                        ));
    public $belongsTo = array('Category' => array(
                           'className' => 'Category'
                           ,'foreignKey' => 'categoryid'
                        ));
}
