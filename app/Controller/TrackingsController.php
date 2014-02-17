<?php
class TrackingsController extends AppController {
	public $helpers = array('Html', 'Form');

	  public function index() {
        $this->set('title_for_layout', 'Currently Tracked Ideas');
        $this->set('trackings', $this->Tracking->find('all'));
    }
}