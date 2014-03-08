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
            'limit' => 15,
            'recursive' => 2
        )));
        $this->set('ideas_inactive', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0),
            'order' => array('Idea.updated ASC'),
            'limit' => 15,
            'recursive' => 2
        )));
        $this->set('ideas_recent', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0),
            'order' => array('Idea.created DESC'),
            'limit' => 15,
            'recursive' => 2
        )));
    }

     public function add() {
        if ($this->request->is('post')) {

            $this->Idea->create();
            $this->request->data['Idea']['created'] = date('Y-m-d H:i:s');
            $this->request->data['Idea']['updated'] = null;
            $this->request->data['Idea']['userid'] = $this->Session->read('Auth.User.id');
            if ($this->Idea->save($this->request->data)) {
                
                $this->saveCategoryInfo($this->request->data['Category'], $this->Idea->getLastInsertID());

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
        $this->set('values', $this->IdeaValue->find('all', array(
            'conditions' => array('ideaid' => $id),
            'fields' => 'Value.id, Value.name, Value.categoryid',
            'recursive'=>2
        )));

        if ($this->request->is('post')) {
            $this->Idea->read(null, $id);
            $this->Idea->set('name', $this->request->data['Idea']['name']);
            $this->Idea->set('description', $this->request->data['Idea']['description']);
            $this->Idea->set('updated',null);

            if ($this->Idea->save()) {
                $this->saveCategoryInfo($this->request->data['Category'], $id);

                //Notify
                App::import('Controller', 'Notifications'); // mention at top
                $Notifications = new NotificationsController; // Instantiation // mention within cron function
                $Notifications->sendNotifications("An Idea you're tracking has been updated", $this->request->data['Idea']['name'], $id, $idea['Idea']['userid'], $this->Session->read('Auth.User.id'));

                $this->Session->setFlash(__('Idea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add idea.'));
        } 

    }

    public function saveCategoryInfo($formdata, $ideaid) {
        //delete all values matching ideaid
        $this->IdeaValue->deleteAll(array('IdeaValue.ideaid' => $ideaid), false);
        //Now add them back in
        foreach($formdata as $key=>$catentry) {
            if (isset($catentry) && $catentry == '') {
                continue;
            }
            $this->IdeaValue->create();
            $this->IdeaValue->set('ideaid', $ideaid);
            $valuearr = explode(',', $catentry);
            $entries = array();
            foreach ($valuearr as $value) {
                //now we have each individual entry in this category
                if (isset($value) && $value != '' && !is_numeric($value)) {
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
                if (isset($ideaid) && isset($value)){
                    $entries[] = array('ideaid' => $ideaid,'valueid'=> $value);
                }
            }
            if (count($entries) > 0 && $this->IdeaValue->saveAll($entries)) {
                //We're good
            } else {
                //ERROR CREATING RELATIONSHIP
            }
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

            //update updated datetime for idea
            $this->Idea->read(null, $id);
            $this->Idea->set('updated',null);
            $this->Idea->save();

            //Notify
            App::import('Controller', 'Notifications'); // mention at top
            $Notifications = new NotificationsController; // Instantiation // mention within cron function
            $Notifications->sendNotifications($username . " commented on " . $idea['Idea']['name'], $c, $id, $idea['Idea']['userid'], $userid);

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