<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Value', 'IdeaValue');
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
        //check if references to this value, if so, set to specified
        //if not, just delete
        if (count($this->IdeaValue->find('all', array('conditions' => array('valueid' => $vid)))) > 0) {
            //set to specified
            //value is in use, instead, we set to specified
            $this->Value->read(null, $vid);
            $this->Value->set('specified', 1); //Value
            if ($this->Value->save()) {
                $this->set('response','success');
                $this->set('data', array());
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response','failed');
                $this->set('data', array());
                $this->render('/Elements/jsonreturn');
            }
        } else {
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

    public function getCategoryIds(){
        $this->layout = null;

        $categoryIds = $this->Category->find('all',array('fields' => array('Category.id')));
        //$this->set('categoryIds', $this->Category->find('all',array('fields' => array('Category.id'))));

        $this->set('response', 'success');
        $this->set('data', $categoryIds);
        $this->render('/Elements/jsonreturn');

    }
}