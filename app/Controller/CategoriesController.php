<?php
class CategoriesController extends AppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('Value', 'IdeaValue');
    var $components = array('RequestHandler');
    
    /*
     * Renders the list of categories
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  A view with the list of categories will be rendered
    */
    public function index() {
        $this->set('title_for_layout', 'Categories');
        $this->set('categories', $this->Category->find('all'));
    }

    /*
     * Renders the list of values for a category
     * input:
        REST parameters: category id
        Query Parameters: None
     * preconditions: category id is valid
     * postconditions:  A view with the list of values for a given category will be rendered
    */
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

    /*
     * Deletes a value from a category
     * input:
        REST parameters: value id
        Query Parameters: None
     * preconditions: the value exists and is valid
     * postconditions:  The ideavalue will be set to "specified" if there are references that exist, otherwise, delete the value
    */
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

    /*
     * Edits a value within a category
     * input:
        REST parameters: value id
        Query Parameters: new value name
     * preconditions: value exists and is valid
     * postconditions: the name of the value changes
     * url example: /categories/1/edit?name=NewValue
    */
    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid value'));
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

    /*
     * Creates a new value in a category
     * input:
        REST parameters: category id
        Query Parameters: name
     * preconditions: the category exists and is valid
     * postconditions:  A new value will be added to the specified category
    */
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
                $this->set('data', array('dataid' => $this->Value->getLastInsertID(), 'dataname' => $this->request->query['name']));
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response','failed');
                $this->set('data', array());
                $this->render('/Elements/jsonreturn');
            }
        }
    }

    /*
     * Returns the list of category ids
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  A json list of category ids is returned.
    */
    public function getCategoryIds(){
        $this->layout = null;

        $categoryIds = $this->Category->find('all',array('fields' => array('Category.id')));
        //$this->set('categoryIds', $this->Category->find('all',array('fields' => array('Category.id'))));

        $this->set('response', 'success');
        $this->set('data', $categoryIds);
        $this->render('/Elements/jsonreturn');

    }
}