<?php 
class Tracking extends AppModel {
    public $belongsTo = array(
            'Idea' => array('Idea' => 'Idea'
                            ,'className' => 'Idea'
                            ,'foreignKey' => 'ideaid'
            )
        );
}
