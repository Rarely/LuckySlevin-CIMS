<?php

App::uses('AppController', 'Controller');

class IdeasController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('RequestHandler');
    public $uses = array('Idea','Comment', 'Category', 'IdeaValue', 'Value', 'IdeaReference', 'IdeaFile');
    
    /*
     * Renders the list of ideas.  This is the home page
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  A view with the list of ideas will be rendered
    */
    public function index() {
        $this->set('title_for_layout', 'Ideas');

        $this->set('ideas_active', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0, 'NOT' => array('Idea.userid' => null)),
            'order' => array('Idea.updated DESC'),
            'limit' => 15,
            'recursive' => 2
        )));
        $this->set('ideas_inactive', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0, 'NOT' => array('Idea.userid' => null)),
            'order' => array('Idea.updated ASC'),
            'limit' => 15,
            'recursive' => 2
        )));
        $this->set('ideas_recent', $this->Idea->find('all', array(
            'conditions' => array('Idea.isdeleted' => 0, 'NOT' => array('Idea.userid' => null)),
            'order' => array('Idea.created DESC'),
            'limit' => 15,
            'recursive' => 2
        )));
    }

    /*
     * Creates a new idea
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: The form data is successfully validated
     * postconditions:  A new idea will be created with the specified form data.
    */
    public function add() {
        if ($this->request->is('post')) {
            $this->Idea->create();
            $this->request->data['Idea']['created'] = date('Y-m-d H:i:s');
            $this->request->data['Idea']['updated'] = null;
            if ($this->Idea->save($this->request->data)) {
                $newid = $this->Idea->getLastInsertID();
                $this->saveCategoryInfo($this->request->data['Category'], $newid);
                $this->saveIdeaReferences($this->request->data['Idea']['references'], $newid);
                $this->saveIdeaFiles($this->request->data['Idea']['files'], $newid);
                //check if this was a split idea
                if (isset($this->request->data['Idea']['parentid']) && !empty($this->request->data['Idea']['parentid']))  {
                    $this->IdeaReference->save(array('ideaid' => $this->request->data['Idea']['parentid'],'refers_to'=> $newid));
                }
                $this->Session->setFlash(__('Idea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add idea.'));
        }
    }
    
    /*
     * Renders the public facing widget for the community to suggest ideas
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  A new idea will be added with minimal information
    */
    public function add_community($id = null) {
        $this->layout= false;
        if ($this->request->is('post')) {

            $this->Idea->create();
            $this->request->data['Idea']['created'] = date('Y-m-d H:i:s');
            $this->request->data['Idea']['updated'] = null;
            $this->request->data['Idea']['userid'] = $this->Session->read('Auth.User.id');
            if ($this->Idea->save($this->request->data)) {
             
                $this->Session->setFlash(__('Idea has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add idea.'));
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add_community');
        //$this->Auth->authorize = array('Controller');
    } 

    /*
     * Renders an idea or saves an edited idea
     * input:
        REST parameters: idea id
        Query Parameters: None
     * preconditions:   the idea exists and is valid
                        if a http post: form data is validated
     * postconditions:  1. The edit form will be shown
                        2. if a http post: the idea will be saved with the form data
    */
    public function edit($id = null) { 
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        $files = $this->IdeaFile->find('all', array('conditions'=>array('ideaid'=>$id)));
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);
        $this->set('files', $files);
        $this->set('values', $this->IdeaValue->find('all', array(
            'conditions' => array('ideaid' => $id),
            'fields' => 'Value.id, Value.name, Value.categoryid',
            'recursive'=>2
        )));
        if ($this->Session->check('page_title') != true) {
            $this->Session->write('page_title', 'Edit an Idea');
            $this->Session->write('page_description', 'Update the contact details, description or categories of this idea');
        }

        if ($this->request->is('post')) {
            $this->Idea->read(null, $id);
            $this->Idea->set('name', $this->request->data['Idea']['name']);
            $this->Idea->set('community_partner', $this->request->data['Idea']['community_partner']);
            $this->Idea->set('contact_name', $this->request->data['Idea']['contact_name']);
            $this->Idea->set('contact_email', $this->request->data['Idea']['contact_email']);
            $this->Idea->set('contact_phone', $this->request->data['Idea']['contact_phone']);
            $this->Idea->set('description', $this->request->data['Idea']['description']);
            $this->Idea->set('start_date', $this->request->data['Idea']['start_date']);
            $this->Idea->set('end_date', $this->request->data['Idea']['end_date']);
            $this->Idea->set('userid', $this->request->data['Idea']['userid']);
            $this->Idea->set('updated',null);
            if ($this->Idea->save()) {
                $this->saveCategoryInfo($this->request->data['Category'], $id);
                $this->cleanupCategoryInfo();
                $this->saveIdeaReferences($this->request->data['Idea']['references'], $id);
                $this->saveIdeaFiles($this->request->data['Idea']['files'], $id);
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

    //USE FOR EDIT AND DELETE
    public function cleanupCategoryInfo() {
        //DELETE FROM cims.values WHERE id NOT IN (SELECT valueid  FROM idea_values) AND values.specified = 1;
        $results = $this->Value->query("DELETE FROM cims.values   
                                        WHERE id NOT IN (SELECT valueid  FROM idea_values)
                                        AND values.specified = 1;");
    }

    /*
     * Provides a copy-able page  for emailing details of an idea
     * input:
        REST parameters: category id
        Query Parameters: name
     * preconditions: the category exists and is valid
     * postconditions:  A new value will be added to the specified category
    */
    public function email($id=null) { 
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
            'fields' => 'Value.name, Value.categoryid',
            'recursive'=>2
        )));
    }

    public function afterFilter() {
        $this->Session->delete('page_title');
        $this->Session->delete('page_description');

    }
    
    /*
     * Saves the idea references.
     * input:
        formdata: the references inputfield
        ideaid: the id of the idea to add references to
     * preconditions: The idea id is valid and existing
     * postconditions:  The idea will now refer to it's child ideas
     * returns: none
    */
    public function saveIdeaReferences($formdata, $ideaid) {
        $this->IdeaReference->deleteAll(array('IdeaReference.ideaid' => $ideaid), false);
        $references = array();
        foreach(explode(',', $formdata) as $idea) {
            if (isset($idea) && $idea == '') {
                continue;
            }
            $references[] = array('ideaid' => $ideaid,'refers_to'=> $idea);
            $references[] = array('ideaid' => $idea,'refers_to'=> $ideaid);
        }
        if (count($references) > 0 && $this->IdeaReference->saveAll($references)) {
            //TODO: Return true
        } else {
            //TODO: Throw Error Can't csave
        }
    }

    /*
    Deletes a file and its reference to the idea
    */
    public function deletefile($id) {
        $this->layout = null;
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $file = $this->IdeaFile->findById($id);
        if (!$file) {
            throw new NotFoundException(__('Invalid idea'));
        }
        if (is_file($file['IdeaFile']['filepath'])) {
            unlink($file['IdeaFile']['filepath']); //delete file
        }
        $this->IdeaFile->delete($id);
        $this->set('response','success');
        $this->set('data', array());
        $this->render('/Elements/jsonreturn');
    }

    /*
    Helper function to save files to an idea, used from add() and edit()
    */
    public function saveIdeaFiles($formdata, $ideaid) {
        if (isset($formdata) && !empty($formdata)) {
            $errormsg = null;
            foreach ($formdata as $f) {
                $fileName = $f["name"]; // The file name
                $fileTmpLoc = $f["tmp_name"]; // File in the PHP tmp folder
                $fileType = $f["type"]; // The type of file it is
                $fileSize = $f["size"]; // File size in bytes
                $fileErrorMsg = $f["error"]; // 0 for false... and 1 for true
                if ($fileErrorMsg != 0) {
                    continue;
                }
                //VALIDATION
                $filetypes = array('image/psd', 'application/zip', 'application/octet-stream', 'application/pdf', 'application/doc', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/gif', 'image/jpg', 'image/jpeg', 'image/bmp', 'application/eps', 'application/postscript');
                $maxsize = 5243000; //5MB
                if (!(in_array($fileType, $filetypes))) {
                    $errormsg = "ERROR: File type not supported.";
                    exit();
                }
                if ($fileSize > $maxsize) {
                    $errormsg = "ERROR: File Size is too large";
                    exit();
                }
                if (!$fileTmpLoc) { // if file not chosen
                    $errormsg = "ERROR: Please browse for a file before clicking the upload button.";
                    exit();
                }
                $filepath = "uploads/$fileName";
                if (is_file($filepath)) {
                    //change name so it will not overwrite others
                    $date = new DateTime();
                    $filepath = "uploads/" . $date->getTimestamp() . "-" . $fileName;
                }

                if(move_uploaded_file($fileTmpLoc, $filepath)){
                    //save to database
                    $this->IdeaFile->saveAll(array('ideaid' => $ideaid,'filepath'=> $filepath, 'filename' => $fileName));
                } else {
                    $errormsg = "Bad Upload";
                }
            }
        }
    }

 

    /*
     * Saves the category values for an idea.
     * input:
        formdata: the list of category input fields
        ideaid: the id of the idea to add category values to
     * preconditions: The idea id is valid and existing
     * postconditions:  The idea will now have category values associated with it.
     * returns: none
    */
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
                $value = trim($value);
                //now we have each individual entry in this category
                if (isset($value) && !empty($value) && !is_numeric($value)) {
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
                if (isset($ideaid) && isset($value) && !empty($value)){
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

    /*
     * Creates a new comment in an idea
     * input:
        REST parameters: idea id
        Query Parameters: message
     * preconditions: the idea exists and is valid
     * postconditions:  A new comment will be added to the specified idea
                        Users tracking the idea and the idea owner will be notified 
    */
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
                $comment = $this->Comment->findById($this->Comment->getLastInsertId());
                $timestamp = $comment['Comment']['created'];
                $this->set('response','success');
                $this->set('data', array('userid'=>$id, 
                    'html' => '<li class="row">
                            <div class= "col-xs-1 comment-avatar">
                              <img src="img/person.png">
                            </div>
                            <div class="col-xs-11">
                              <div class="comment-message">' . $c . '</div>
                              <div class="comment-user">- ' . $username . ' ' . $timestamp . '</div>
                            </div>
                        </li>'
                    ));
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

    /*
     * Views a single idea
     * input:
        REST parameters: idea id
        Query Parameters: None
     * preconditions: the idea exists and is valid
     * postconditions:  Renders the ajax modal for an idea
    */
    public function idea($id = null) {
        $this->layout = false;
        if (!$id) {
            throw new NotFoundException(__('Invalid idea'));
        }

        $idea = $this->Idea->findById($id);
        // $comments = $this->Comment->find('all', array('conditions' => array('Comment.ideaid' => $id), 'recursive' => 2));
        $this->set('comments', $this->Comment->find('all', array(
            'conditions' => array('Comment.ideaid' => $id),
            'order' => array('Comment.created DESC'),
            'recursive' => 2
        )));

        $this->set('ideavalues', $this->IdeaValue->find('all', array(
            'conditions' => array('IdeaValue.ideaid' => $id),
            'recursive'=>2
        )));
        
        if (!$idea) {
            throw new NotFoundException(__('Invalid idea'));
        }
        $this->set('idea', $idea);
        $this->render('/Elements/ajaxmodal');
    }

    /*
     * deletes an idea
     * input:
        REST parameters: None
        Query Parameters: ids = list of idea ids
     * preconditions: the ideas exist and are valid
     * postconditions:  a flag (isdeleted) is turned to true for the list of ideas
    */
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
                    $this->cleanupCategoryInfo();
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

    /*
     * Shares an idea with a list of users
     * input:
        REST parameters: ideaid
        Query Parameters: userids - a comma separated list of user ids to share the idea with
     * preconditions: The user ids are valid and existing user ids
     * postconditions: The users in the list will be sent notifications to look at the idea
     * returns: Ajax Response {“response”: “success”, “data”: “”}
     * url example: /ideas/1/share?userids=1,2,3,5
    */
    function share($id = null) {
        $this->layout = null;
        if ($this->RequestHandler->isAjax()) {
            if (!$id) {
                throw new NotFoundException(__('Invalid idea'));
            }

            $idea = $this->Idea->findById($id);

            if (!$idea) {
                throw new NotFoundException(__('Invalid idea'));
            }

            $userids = @$this->request->query('userids');
            $senderid = $this->Session->read('Auth.User.id');
            $sendername = $this->Session->read('Auth.User.name');

            foreach (explode(',', $userids) as $user) {
                //Notify
                App::import('Controller', 'Notifications'); // mention at top
                $Notifications = new NotificationsController; // Instantiation // mention within cron function
                $Notifications->sendNotifications($sendername . " shared an idea with you.", $idea['Idea']['name'], $id, $user, $senderid);
            }
            $this->set('response', 'success');
            $this->set('data', array());
            $this->render('/Elements/jsonreturn');
        } else {
            $this->set('response', 'failed');
            $this->set('data', array());
            $this->render('/Elements/jsonreturn');
        }
    }

    /*
     * Returns the list of values for a category
     * input:
        REST parameters: category id
        Query Parameters: None
     * preconditions: The category id is valid
     * postconditions: the list of values for a given category is returned
    */
    function valueslist($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
        }

        if ($this->RequestHandler->isAjax()) {
            $values = $this->Value->find('all', array(
                'conditions' => array('categoryid' => $id, 'specified' => 0),
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
    /*
     * Returns the list of ideas
     * input:
        REST parameters: (optional) ideaid
        Query Parameters: None
     * preconditions: The idea id is valid (if given)
     * postconditions: the list of idea are returned.  If the idea id is specified, exclude that idea.
    */
    function idealist($ideaid = null) {
        $term = $this->request->query('q');
        if ($this->RequestHandler->isAjax()) {
            if ($term != null) {
                $conditions['or'][] = array('Idea.name LIKE' => "%$term%");
            }
            if ($ideaid) {
                $results = $this->Idea->find('all', array('conditions' => 'Idea.id != ' . $ideaid, 'fields' => 'Idea.id, Idea.name'));
            } else {
                $results = $this->Idea->find('all', array('fields' => 'Idea.id, Idea.name', 'recursive' => 0));
            }
            foreach ($results as $result) {
                $answer[] = array(
                    "id"=>utf8_encode($result['Idea']['id']),
                    "text" => utf8_encode($result['Idea']['name'])
                );
            }
            $this->set('response', $answer);
            $this->render('/Elements/jsonraw');
        }
    }
}

