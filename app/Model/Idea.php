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
}
?>