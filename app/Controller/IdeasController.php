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

     public function add() {
        if ($this->request->is('post')) {
            $this->Idea->create();
            if ($this->Idea->save($this->request->data)) {
                $this->Session->setFlash(__('Idea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add idea.'));
        }
    }
 
    public function edit($id = null) { 
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);

        if ($this->request->is('post')) {
            $this->Idea->read(null, $id);
            $this->Idea->set('name', $this->request->data['Idea']['name']);
            $this->Idea->set('description', $this->request->data['Idea']['description']);
            $this->Idea->set('status', $this->request->data['Idea']['status']);
             if ($this->Idea->save()) {
                 $this->Session->setFlash(__('Idea has been saved.'));
                 return $this->redirect(array('action' => 'index'));
             }
             $this->Session->setFlash(__('Unable to add idea.'));
        } 
    }
}