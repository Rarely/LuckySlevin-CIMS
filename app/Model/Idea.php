<?php
class Idea extends AppModel {

		public function getAllIdeas() {
			return $this->Idea->find('all');
		}
}
?>