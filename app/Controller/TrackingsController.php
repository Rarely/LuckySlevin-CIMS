<?php
class TrackingsController extends AppController {
	public $helpers = array('Html', 'Form');

	  public function index() {
        $this->set('title_for_layout', 'Currently Tracked Ideas');
        $this->set('trackings', $this->Tracking->find('all'));
    }

    // //public function view($userid = null) {
    // //    if (!$userid) {
    //         throw new NotFoundException(__('Invalid User ID'));
    //     }

    //     $tracking = $this->Tracking->findById($userid);
    //     if (!$tracking) {
    //         throw new NotFoundException(__('Invalid User ID'));
    //     }
    //     $this->set('tracking', $tracking);
    // }
}