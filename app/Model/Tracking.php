<?php 
class Tracking extends AppModel {
    public $belongsTo = array(
            'User' => array('User' => 'User'
                            ,'className' => 'User'
                            ,'foreignKey' => 'userid'
            ),
            'Idea' => array('Idea' => 'Idea'
                            ,'className' => 'Idea'
                            ,'foreignKey' => 'userid'
            )
        );
}
