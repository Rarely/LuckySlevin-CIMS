<?php
class HelpController extends AppController {
    public $helpers = array('Html', 'Form');

    public function view($id = null) {
        $this->set('title_for_layout', 'Help');
        
        if (!$id) {
            throw new NotFoundException(__('Failed to load help page'));
        }

        $help = $this->Help->findById($id);
        if (!$help) {
            throw new NotFoundException(__('Failed to load help page'));
        }
        $this->set('help', $help);


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
                return $this->redirect(array('action' => 'view', $id));
            }
            $this->Session->setFlash(__('Unable to update Help page.'));
        }

        if (!$this->request->data) {
            $this->request->data = $help;
        }
    }
}
