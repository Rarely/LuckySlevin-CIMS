<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Value');
    var $components = array('RequestHandler');
    
    public function index() {
        $this->set('title_for_layout', 'Categories');
        $this->set('categories', $this->Category->find('all'));
    }

    public function view($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }

        $category = $this->Category->findById($id);
        if (!$category) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->set('category', $category);
    }

    public function delete($vid = null) {
        if (!$vid) {
            throw new NotFoundException(__('Invalid value'));
        }
        if ($this->Value->delete($vid)) {
            $this->set('response','success');
            $this->set('data', array());
            $this->render('/Elements/jsonreturn');
        } else {
            $this->set('response','failed');
            $this->set('data', array());
            $this->render('/Elements/jsonreturn');
        }
    }
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->Value->read(null, $id);
        $this->Value->set('name', $this->request->query['name']); //Value
        if ($this->Value->save()) {
            $this->set('response','success');
            $this->set('data', array());
            $this->render('/Elements/jsonreturn');
        } else {
            $this->set('response','failed');
            $this->set('data', array());
            $this->render('/Elements/jsonreturn');
        }
    }
    public function create($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->RequestHandler->isAjax()) {
            $this->Value->create();
            $this->Value->set('name', $this->request->query['name']); //Value
            $this->Value->set('categoryid', $id); //CatID
            $this->Value->set('specified', false); //specified manually
            if ($this->Value->save()) {
                $this->set('response','success');
                $this->set('data', array('dataid' => $this->Value->getLastInsertID()));
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response','failed');
                $this->set('data', array());
                $this->render('/Elements/jsonreturn');
            }
        }
    }
}