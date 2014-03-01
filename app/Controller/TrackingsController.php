<?php
class TrackingsController extends AppController {
	public $helpers = array('Html', 'Form', 'Js');
    var $components= array('Session', 'RequestHandler');

    public function index() {
        $this->set('title_for_layout', 'Currently Tracked Ideas');
        $this->set('ideas', $this->Tracking->find('all', array(
            'conditions' => array(
                'Idea.isdeleted' => 0,
                'Tracking.userid' => $this->Session->read('Auth.User.id'))
            ,'recursive' => 2
        )));
    }

    public function track($id = null) {
        $this->layout = null; //disable layout for json return
        if ($this->RequestHandler->isAjax()) {
            if(!$id) {
                $id = @$this->request->query('id');
            }
            if (!$id) {
                throw new NotFoundException(__('No id'));
            } 
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
        } else {
            //non-ajax
            $this->set('response', 'failed');
            $this->set('data', $id);
            $this->render('/Elements/jsonreturn');
        }
    }

    public function untrack($id = null) {
        $this->layout = null; //disable layout for json return
        if ($this->RequestHandler->isAjax()) {
            if(!$id) {
                $id = @$this->request->query('id');
            }
            if (!$id) {
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