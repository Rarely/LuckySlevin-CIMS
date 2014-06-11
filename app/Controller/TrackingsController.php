<?php
App::uses('AppController', 'Controller');

class TrackingsController extends AppController {
	public $helpers = array('Html', 'Form', 'Js');
    public $uses = array('Idea');
    var $components= array('Session', 'RequestHandler');
    
    /*
     * Renders the My Page page
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  A viwe with the list of owned and tracked ideas is rendered
    */
    public function index() {
        $this->set('title_for_layout', 'My Page');
        $trackedIdeas = $this->Tracking->find('all', array(
            'Idea.isdeleted' => 0,
            'conditions' => array('Tracking.userid' => $this->Session->read('Auth.User.id')),
            'recursive' => 3
        ));
        foreach ($trackedIdeas as &$idea) {
            $idea['Users'] = $idea['Idea']['Users'];
            $idea['Idea_Value'] = $idea['Idea']['Idea_Value'];
        }
        $this->set('ideas', $trackedIdeas);
        
        $this->set('ownedideas', $this->Idea->find('all', array(
            'Idea.isdeleted' => 0,
            'conditions' => array('Idea.userid' => $this->Session->read('Auth.User.id')),
            'recursive' => 3
        )));
        $this->set('ideas_unassigned', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0, 'Idea.userid' => null),
            'order' => array('Idea.created DESC'),
            'limit' => 15,
            'recursive' => 2
        )));
    }

    /*
     * Tracks an idea
     * input:
        REST parameters: idea id
        Query Parameters: None
     * preconditions:   user is logged in
                        the idea is valid
     * postconditions:  the user tracks the given idea
    */
    public function track($id = null) {
        $this->layout = null; //disable layout for json return
        if ($this->RequestHandler->isAjax()) {
            if(!$id) {
                $id = @$this->request->query('id');
            }
            if (!$id || !is_numeric($id)) {
                throw new NotFoundException(__('No id'));
            } 
            if ($this->Tracking->hasAny(array(
                'userid' => $this->Auth->user('id'),
                'ideaid' => $id
            ))){
                $this->set('response', 'success');
                $this->set('data', $id);
                $this->render('/Elements/jsonreturn');
            } else {
                $tracking = $this->Tracking->create();
                $tracking['Tracking']['userid'] = $this->Auth->user('id');
                $tracking['Tracking']['ideaid'] = $id;
                if ($this->Tracking->save($tracking)) {
                    $this->set('response', 'success');
                    $this->set('data', $id);
                    $this->render('/Elements/jsonreturn');
                } else {
                    $this->set('response', 'failed');
                    $this->set('data', $id);
                    $this->render('/Elements/jsonreturn');
                }
            }
        } else {
            //non-ajax
            $this->set('response', 'failed');
            $this->set('data', $id);
            $this->render('/Elements/jsonreturn');
        }
    }

    /*
     * Untracks an idea
     * input:
        REST parameters: idea id
        Query Parameters: None
     * preconditions:   user is logged in
                        the idea is valid
     * postconditions:  the user untracks the given idea
    */
    public function untrack($id = null) {
        $this->layout = null; //disable layout for json return
        if ($this->RequestHandler->isAjax()) {
            if(!$id) {
                $id = @$this->request->query('id');
            }
            if (!$id || !is_numeric($id)) {
                throw new NotFoundException(__('No id'));
            } 
            
            if ($this->Tracking->deleteAll(array('Tracking.userid' => $this->Auth->user('id'), 'Tracking.ideaid' => $id), false)) {
                $this->set('response', 'success');
                $this->set('data', $id);
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response', 'failed');
                $this->set('data', $id);
                $this->render('/Elements/jsonreturn');
            }
        } else {
            //non-ajax
            $this->set('response', 'failed');
            $this->set('data', $id);
            $this->render('/Elements/jsonreturn');
        }
    }
}