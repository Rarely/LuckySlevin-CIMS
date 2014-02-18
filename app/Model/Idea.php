<?php
class Idea extends AppModel {
        public $hasMany = array(
            'Comments' => array('Comments' => 'Comments'
                                ,'className' => 'Comments'
                                ,'foreignKey' => 'ideaid'
                                ,'order' => 'Comments.created ASC'
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
        )
        // 'status' => array(
        //     'valid' => array(
        //         'rule' => array('inList', array('open', 'referred', 'matched')),
        //         'message' => 'Please enter a valid role',
        //         'allowEmpty' => false
        //     )
	   );
}
?>