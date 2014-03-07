<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Value');
    
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
            $this->Session->setFlash(__('Value has been deleted.'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Unable to delete value.'));

    }

    public function add($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is('post')) {
            $this->Value->create();
            $this->Value->set('name', $this->request->data['Value']['name']); //Value
            $this->Value->set('categoryid', $id); //CatID
            $this->Value->set('specified', false); //specified manually
            if ($this->Value->save()) {
                $this->Session->setFlash(__('Category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add category.'));
        }
    }
}