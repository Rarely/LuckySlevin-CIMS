<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');
    
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

    public function add() {
        if ($this->request->is('post')) {
            $this->Category->create();
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add category.'));
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