<?php
class TrackingsController extends AppController {
	public $helpers = array('Html', 'Form', 'Js');
    var $components= array('Session', 'RequestHandler');

    public function index() {
        $this->set('title_for_layout', 'Currently Tracked Ideas');
        $this->set('trackings', $this->Tracking->find('all', array(
            'conditions' => array('Tracking.userid' => $this->Session->read('Auth.User.id'))
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
            //handle ajax
            $this->set('response', 'success');
            $this->set('data', $id);
            $this->render('/Elements/jsonreturn');

        } else {
            //non-ajax
            $this->set('response', 'failed');
            $this->set('data', $id);
            $this->render('/Elements/jsonreturn');
        }
    }
}