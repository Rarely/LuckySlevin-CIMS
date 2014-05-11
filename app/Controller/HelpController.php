<?php
// app/Controller/HelpController.php

class HelpController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components= array('Session', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to view help pages
        $this->Auth->allow('index');
        $this->Auth->authorize = array('Controller');
    }

    public function index($id = null) {
        $this->set('title_for_layout', 'Help');

        if ($this->Session->read('Auth.User.role') === 'admin'){
            $this->set('helps', $this->Help->find('all',
                                    array('order' => array('Help.name'))));
        } else {
            $this->set('helps', $this->Help->find('all',
                                    array('conditions' => array('Help.admin' => 0),
                                            'order' => array('Help.name'))));
        }
        $this->set('helpToDisplay', $id);
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Failed to load help page'));
        }

        $help = $this->Help->findById($id);
        if (!$help) {
            throw new NotFoundException(__('Failed to load help page'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Help->id = $id;
            if ($this->Help->save($this->request->data)) {
                $this->Session->setFlash(__('Help page has been updated.'));
                return $this->redirect(array('action' => 'index', $id));
            }
            $this->Session->setFlash(__('Unable to update Help page.'));
        }

        if (!$this->request->data) {
            $this->request->data = $help;
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Idea']['updated'] = null;
            $this->Help->create();
            if ($this->Help->save($this->request->data)) {
                $this->Session->setFlash(__('Help page has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to create Help page.'));
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Help->delete($id)) {
            $this->Session->setFlash(__('Help page has been deleted.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to delete Help page.'));
    }
}
