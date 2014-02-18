<?php
class SearchController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Idea');

    public function index($q = null) {
        $this->set('title_for_layout', 'Search');

        if ($this->request['data']) {
            $q = $this->request['data']['Search']['q'];
            $this->set('query', $q);
            $this->set('ideas', $results = $this->Idea->find('all',
                                    array('conditions' => array(
                                            'Idea.name LIKE' => '%' . $q . '%')
            )));
        } else {
            $this->set('query', '');
            $this->set('ideas', array());
        }
    }
}