<?php
class SearchController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Idea');

    public function index() {
        $this->set('title_for_layout', 'Search');
        $this->set('ideas', $this->Idea->find('all'));
    }
}