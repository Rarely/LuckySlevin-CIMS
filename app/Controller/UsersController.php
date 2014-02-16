<?php
class UsersController extends AppController {
    public $helpers = array('Html', 'Form');
    
    public function index() {
        $this->set('title_for_layout', 'Users');
        $this->set('users', $this->User->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $user);
    }
}