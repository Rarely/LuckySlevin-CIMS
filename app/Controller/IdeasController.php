<?php
class IdeasController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('title_for_layout', 'Ideas');
        $this->set('ideas', $this->Idea->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);
    }
}