<?php
class Idea extends AppModel {
        public $hasMany = array(
            'Comments' => array('Comments' => 'Comments'
                                ,'className' => 'Comments'
                                ,'foreignKey' => 'ideaid'
                                ,'order' => 'Comments.created DESC'
            ),
            'Idea_Value' => array('Idea_Value' => 'Idea_Value'
                                ,'className' => 'IdeaValue'
                                ,'foreignKey' => 'ideaid'
            ),
            'Idea_File' => array('Idea_File' => 'Idea_File'
                                ,'className' => 'IdeaFile'
                                ,'foreignKey' => 'ideaid'
                                ,'joinTable' => 'idea_files'
            ),
        );
        public $hasAndBelongsToMany = array(
          'References' => array(
            'className' => 'Idea',
            'joinTable' => 'idea_references',
            'foreignKey' => 'ideaid',
            'associationForeignKey' => 'refers_to',
            'unique' => true,
          )
        );
        public $belongsTo = array(
            'Users' => array('Users' => 'Users',
                             'className' => 'Users',
                             'foreignKey' => 'userid'
            )
        );        

		public function getAllIdeas() {
			return $this->Idea->find('all');
		}

		public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'description' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A description is required'
            )
        ),
    //     'status' => array(
    //         'valid' => array(
    //             'rule' => array('inList', array('open', 'referred', 'matched')),
    //             'message' => 'Please enter a valid status',
    //             'allowEmpty' => false
    //         )
	   // ));
        );
}
?>