<?php
class TrackingsController extends AppController {
	public $helpers = array('Html', 'Form');
    var $components= array('Session');

    public function index() {
        $this->set('title_for_layout', 'Currently Tracked Ideas');
        $this->set('trackings', $this->Tracking->find('all', array(
            'conditions' => array('Tracking.userid' => $this->Session->read('Auth.User.id'))
            ,'recursive' => 2
        )));
    }
}