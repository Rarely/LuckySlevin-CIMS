<?php
class IdeasController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('RequestHandler');
    public $uses = array('Idea','Comment');
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

    public function comment($id = null){
        $this->layout = null;
        if ($this->RequestHandler->isAjax()) {
            if (!$id) {
                throw new NotFoundException(__('Invalid idea'));
            }

            $idea = $this->Idea->findById($id);
            
            if (!$idea) {
                throw new NotFoundException(__('Invalid idea'));
            }

            $c = @$this->request->query('c');
            $userid = $this->Session->read('Auth.User.id');
            $username = $this->Session->read('Auth.User.name');

            $comment = $this->Comment->create();
            $comment['Comment']['userid'] = $userid;
            $comment['Comment']['ideaid'] = $id;
            $comment['Comment']['message'] = $c;
            $comment['Comment']['created'] = null; //!important

            if ($this->Comment->save($comment)){
                $this->set('response','success');
                $this->set('data', array('userid'=>$id, 'html' => '<li>' . $username . ': ' . $c . '</li>'));
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response','failed');
                $this->set('data', array('Could not save'));
                $this->render('/Elements/jsonreturn');
            } 
        }
        else { 
                $this->set('response','failed');
                $this->set('data', array('Not ajax'));
                $this->render('/Elements/jsonreturn');
        }
        
    }

    public function idea($id = null) {
        $this->layout = false;
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        // $comments = $this->Comment->find('all', array('conditions' => array('Comment.ideaid' => $id), 'recursive' => 2));
        $this->set('comments', $this->Comment->find('all', array(
            'conditions' => array('Comment.ideaid' => $id)
            ,'recursive' => 2
        )));
        
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);
        $this->render('/Elements/ajaxmodal');
    }
}