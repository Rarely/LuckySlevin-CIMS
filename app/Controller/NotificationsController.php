<?php
class NotificationsController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('title_for_layout', 'Notifications');
        $this->set('notifications', $this->Notification->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Notification'));
        }

        $notification = $this->Notifications->findById($id);
        if (!$notification) {
            throw new NotFoundException(__('Invalid Notification'));
        }
        $this->set('notifications', $notification);
    }
}