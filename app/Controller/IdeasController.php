<?php
class IdeasController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('RequestHandler');
    public $uses = array('Idea','Comment', 'Category', 'IdeaValue', 'Value');
    public function index() {
        $this->set('title_for_layout', 'Ideas');

        $this->set('ideas_active', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0),
            'order' => array('Idea.updated DESC'),
            'limit' => 15
        )));
        $this->set('ideas_inactive', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0),
            'order' => array('Idea.updated ASC'),
            'limit' => 15
        )));
        $this->set('ideas_recent', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0),
            'order' => array('Idea.created DESC'),
            'limit' => 15
        )));
    }

     public function add() {
        if ($this->request->is('post')) {

            $this->Idea->create();
            $this->request->data['Idea']['created'] = date('Y-m-d H:i:s');
            $this->request->data['Idea']['updated'] = null;
            $this->request->data['Idea']['userid'] = $this->Session->read('Auth.User.id');
            if ($this->Idea->save($this->request->data)) {
                $id = $this->Idea->getLastInsertID();
                foreach($this->request->data['Category'] as $key=>$value) {
                    $this->IdeaValue->create();
                    $this->IdeaValue->set('ideaid', $id);
                    //TODO: CHECK FOR SPECIFIED STRING OR INTEGER
                    if (!is_numeric($value)) {
                        //create value and return id
                        $this->Value->create();
                        $this->Value->set('name', $value); //Value
                        $this->Value->set('categoryid', $key); //CatID
                        $this->Value->set('specified', true); //specified manually
                        if ($this->Value->save()) {
                            $value = $this->Value->getLastInsertID();
                        } else {
                            //ERROR creating specific value
                        }
                    }
                    $this->IdeaValue->set('valueid', $value);
                    if ($this->IdeaValue->save()) {
                            //We're good
                    } else {
                        //ERROR CREATING RELATIONSHIP
                    }
                }
                $this->Session->setFlash(__('Idea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add idea.'));
        }
    }
 
    public function edit($id = null) { 
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);

        if ($this->request->is('post')) {
            $this->Idea->read(null, $id);
            $this->Idea->set('name', $this->request->data['Idea']['name']);
            $this->Idea->set('description', $this->request->data['Idea']['description']);
            $this->Idea->set('status', $this->request->data['Idea']['status']);
            $this->Idea->set('updated', null);
             if ($this->Idea->save()) {
                 $this->Session->setFlash(__('Idea has been saved.'));
                 return $this->redirect(array('action' => 'index'));
             }
             $this->Session->setFlash(__('Unable to add idea.'));
        } 

    }

    public function comment($id = null){
        $this->layout = null;
        if ($this->RequestHandler->isAjax()) {
            if (!$id) {
                throw new NotFoundException(__('Invalid idea'));
            }

            $idea = $this->Idea->findById($id);
            
            if (!$idea) {
                throw new NotFoundException(__('Invalid idea'));
            }

            $c = @$this->request->query('c');
            $userid = $this->Session->read('Auth.User.id');
            $username = $this->Session->read('Auth.User.name');

            $comment = $this->Comment->create();
            $comment['Comment']['userid'] = $userid;
            $comment['Comment']['ideaid'] = $id;
            $comment['Comment']['message'] = $c;
            $comment['Comment']['created'] = null; //!important

            if ($this->Comment->save($comment)){
                $this->set('response','success');
                $this->set('data', array('userid'=>$id, 'html' => '<li>' . $username . ': ' . $c . '</li>'));
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response','failed');
                $this->set('data', array('Could not save'));
                $this->render('/Elements/jsonreturn');
            } 
        }
        else { 
                $this->set('response','failed');
                $this->set('data', array('Not ajax'));
                $this->render('/Elements/jsonreturn');
        }
        
    }

    public function idea($id = null) {
        $this->layout = false;
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        // $comments = $this->Comment->find('all', array('conditions' => array('Comment.ideaid' => $id), 'recursive' => 2));
        $this->set('comments', $this->Comment->find('all', array(
            'conditions' => array('Comment.ideaid' => $id)
            ,'recursive' => 2
        )));

        $this->set('categories', $this->Category->find('all', array(
            // 'conditions' => array('idea_value.ideaid' => $id)
            'recursive'=>0
        )));

        $this->set('ideavalues', $this->IdeaValue->find('all', array(
            'conditions' => array('IdeaValue.ideaid' => $id)
            ,'recursive'=>2
        )));
        
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);
        $this->render('/Elements/ajaxmodal');
    }

    public function delete($idlist = array()) {
        $idlist = explode(',', $this->request->query('ids'));
        
        $this->layout = null;
        if ($this->RequestHandler->isAjax()) {
            if ($this->request->is('post')) {
                $deletedlist = array();
                $errors = array();
                foreach($idlist as $id) {
                    $this->Idea->read(null, $id);
                    $this->Idea->set('isdeleted', 1);
                    $this->Idea->set('updated', null);

                    if ($this->Idea->save()) {
                        array_push($deletedlist, $id);
                    } else {
                        array_push($errors, $id);
                    }
                }

                if (count($errors) == 0) {
                    $this->set('response','success');
                    $this->set('data', $deletedlist);
                    $this->render('/Elements/jsonreturn');
                } else {
                    $this->set('response','failed');
                    $this->set('data', $errors);
                    $this->render('/Elements/jsonreturn');
                } 
            } else {
                $this->set('response','failed');
                $this->set('data', $errors);
                $this->render('/Elements/jsonreturn');
            } 
        } else { 
            $this->set('response','failed');
            $this->set('data', $errors);
            $this->render('/Elements/jsonreturn');
        }

    }

    function valueslist($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        if ($this->RequestHandler->isAjax()) {
            $values = $this->Value->find('all', array(
                'conditions' => array('categoryid' => $id),
                'fields' => 'Value.id, Value.name',
                'recursive'=>2
            ));
            foreach ($values as $result) {
                $answer[] = array(
                    "id"=>$result['Value']['id'],
                    "text" => $result['Value']['name'],
                );
            }

            $this->set('response', $answer);
            $this->render('/Elements/jsonraw');
        }
    }
}