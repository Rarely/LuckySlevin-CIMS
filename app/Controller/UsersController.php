<?php 
// app/Controller/UsersController.php

App::uses('AppController', 'Controller');

class UsersController extends AppController {
    var $uses =array('User','Ticket', 'CakeEmail', 'Network/Email');
    var $helpers = array('Html', 'Form');
    var $components =array('Email','Ticketmaster', 'RequestHandler');
    
    /*
     * Renders the list of users
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  A view with the list of users will be rendered
    */
    public function index() {
        $this->set('title_for_layout', 'Users');
        $this->set('users', $this->User->find('all', array( 
            'conditions' => array('User.isdeleted' => 0)
        )));
    }
    
    /*
     * Edits a user 
     * input:
        REST parameters: user id
        Query Parameters: None
     * preconditions: user exists and is valid
     * postconditions: the user's information changes
    */
    public function edit($id = null) { 
        if (!$id) {
            throw new NotFoundException(__('Invalid User'));
        }

        $user = $this->User->findById($id);
        
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }
        $this->set('user', $user);

        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            if ($this->User->save($this->request->data, true, array('name', 'username', 'role'))) {
                $this->Session->setFlash(__('User has been saved.'), 'default', array(), 'gooduser');
                return $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update a user.'), 'default', array(), 'baduser');
            return $this->redirect(array('controller' => 'users', 'action' => 'index'));
        } 
    }

    /*
     * Creates a new user
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: the form data is validated
     * postconditions:  A new user is created in the database
    */
    public function add() {
        if ($this->request->is('post')) {
            $user = $this->User->findByUsername($this->request->data['User']['username']);

            if ($user) { 
                if ($user['User']['isdeleted'] == true) {
                    $this->activateDeletedUser($this->request->data['User']['username']);
                    $this->Session->setFlash(__('User already exists, Re-activation email sent.'), 'default', array(), 'gooduser');
                    return $this->redirect(array('controller'=>'users', 'action' => 'index'));
                } else {
                    $this->Session->setFlash(__('User already exists in the system.'), 'default', array(), 'baduser');
                    return $this->redirect(array('controller' => 'users', 'action' => 'index'));  
                }
            } else {
                $this->User->create();
                $this->User->set('password', 'temporary');

                if ($this->User->save($this->request->data)) {
                    //issue reset password for new user
                    $this->resetpassword($this->request->data['User']['username']);
                    $this->Session->setFlash(__('User has been saved.'), 'default', array(), 'gooduser');
                    return $this->redirect(array('controller' => 'users', 'action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to add user. Please try again'), 'default', array(), 'baduser');
                return $this->redirect(array('controller' => 'users', 'action' => 'index'));
            }
        }
    }

    /*
     * Activates a deleted user
     * input:
        REST parameters: username
        Query Parameters: None
     * preconditions: The user exists
     * postconditions:  if the user is deleted, undelete it
    */
    public function activateDeletedUser($username = null) {
        if (!$username) {
            throw new NotFoundException(__('Invalid User'));
        }
        $user = $this->User->findByUsername($username);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }
        if($user['User']['isdeleted'] == true){
            $this->User->read(null, $user['User']['id']);
            $this->User->set('password', 'temporary');
            $this->User->set('isdeleted', '0'); 
             if ($this->User->save()) {
                 //issue reset password even if they are a previous user to show account reactivation
                 $this->resetpassword($user['User']['username']);
                 return true;
             }
        }
        return false;
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('logout','resetpassword','useticket', 'newpassword', 'memberslist');
        $this->Auth->authorize = array('Controller');
    }   

    /*
     * Logs in a user
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  renders the login page or logs the user in.
    */
    public function login() {
        $this->layout= false;
        if ($this->request->is('post')) {
            $user = $this->User->findByUsername($this->request->data['User']['username']);

            if (isset($user) && !is_null($user) && !empty($user) && $user['User']['isdeleted'] == false && $this->Auth->login()) {
                 return $this->redirect($this->Auth->redirectUrl());
           } 
            if(!$user || !$this->Auth->login() || $user['User']['isdeleted'] == true){
                 $this->Session->setFlash(__('Invalid username or password, try again'), 'default', array(), 'badlogin');
           } 
       }
    }

    /*
     * Logs out a user
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: None
     * postconditions:  logs a user out. clears the session variable
    */
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /*
     * renders the reset password page
     * input:
        REST parameters: email (optional)
        Query Parameters: None
     * preconditions: the email is linked to a valid user
     * postconditions:  a ticket is created and an email is sent to the user.
    */
    function resetpassword($email=null){
        $this->layout = false;
        $redirect = true;
        if (isset($email) && !empty($email)) {
            $this->request->data['User']['email'] = $email;
            $redirect = false;
        }

        if(!empty($this->request->data['User']['email'])){
            //already entered email
            if(!$email) $email=$this->request->data['User']['email'];
            // make sure whave email and a check
            if(!$email){
                $this->User->invalidate('email');
            }else{
                //email entered, check for it
                $account=$this->User->findByUsername($email);

                if(!isset($account['User']['username']) && $redirect == true){
                    $this->Session->setFlash('If you have provided a valid email address, you will receive further password reset instructions shortly', 'default', array(), 'goodlogin');
                    $this->redirect('/');
                }
                $hashyToken=md5(date('mdY').rand(4000000,4999999));
                $message = $this->Ticketmaster->createMessage($hashyToken);
                
                $Email = new CakeEmail();
                App::uses('CakeEmail', 'Network/Email');
                $Email->config('default');
                
                $Email->to($account['User']['username']);
                $Email->subject('Password Reset');
                $Email->send($message);
                $data['Ticket']['hash']=$hashyToken;
                $data['Ticket']['data']=$email;
                $data['Ticket']['expires']=$this->Ticketmaster->getExpirationDate();

                if ($this->Ticket->save($data)){
                    if ($redirect == true) {
                        $this->Session->setFlash('An email has been sent with instructions to reset your password', 'default', array(), 'goodlogin');
                        $this->redirect('/');
                    }
                }else{
                    if ($redirect == true) {
                        $this->Session->setFlash('Ticket could not be issued', 'default', array(), 'badlogin');
                        $this->redirect('/');
                    }
                }
            }
        }
    }
    
    /*
     * Uses a ticket
     * input:
        REST parameters: hash
        Query Parameters: None
     * preconditions: the ticket is valid
     * postconditions: applied the action of the ticket.
    */
    function useticket($hash){
        //purge old tickets
        $results=$this->Ticketmaster->checkTicket($hash);
 
        if($results){
            //now pull up mine IF still present
            $passTicket=$this->User->findByUsername($results['Ticket']['data']);
 
            $this->Ticketmaster->voidTicket($hash);
            $this->Session->write('tokenreset',$passTicket['User']['id']);
            $this->Session->setFlash('Enter your new password below');
            $this->redirect('/users/newpassword/'.$passTicket['User']['id']);
        }else{
            $this->Session->setFlash('Your ticket is lost or expired.', 'default', array(), 'badlogin');
            $this->redirect('/');
        }
 
    }
 
    /*
     * renders the new password page
     * input:
        REST parameters: user id
        Query Parameters: None
     * preconditions: the user id is valid
     * postconditions: The users password is reset
    */
    function newpassword($id = null) {
        $this->layout = false;
        //check if they're logged in as somebody (admin?)
        if ($this->Session->check('Auth.User')){
            $this->Auth->logout();
        }
        if($this->Session->check('tokenreset')){
            //user is not logged in, BUT has TOKEN in hand
        }else{
            // But you only want authenticated users to access this action.
            //lines like the one below 'checkSession are  authentication code, so you can ignore these or use Auth
            $this->checkSession(1,'/users/edit/'.$id);
 
            //But youll need to read the user info somehow, and only the user who owns the profile 
            $attempter=$this->Session->read('User');
        }   
 
        if (empty($this->request->data)) {
            if($this->Session->check('tokenreset')) $id=$this->Session->read('tokenreset');
            if (!$id) {
                $this->Session->setFlash('Invalid id for User');
                $this->redirect('/users/index');
            }
            $this->request->data = $this->User->read(null, $id);
        } else {                
            // $this->request->data['User']['password']=AuthComponent::password($this->request->data['User']['password']);
            $data = array(
                'id' => $this->request->params['pass'][0],
                'password' => $this->request->data['User']['password']
            );
            if ($this->User->save($data)) {
                //delkete session token and dlete used ticket from table
                $this->Session->delete('tokenreset');
                $this->Session->setFlash('The User\'s Password has been updated', 'default', array(), 'goodlogin');
                $this->redirect('/');
            } else {
                $this->Session->setFlash('Please correct errors below.');
            }
        }
    }

    /*
     * returns the list of users
     * input:
        REST parameters: excludeself
        Query Parameters: term
     * preconditions: None
     * postconditions: the list of members are returned
                        if exclude self is true, the list removes the user.
                        if term is specified, it searches for the user.
    */
    function memberslist($excludeSelf = false) {
        $this->layout = false;
        $term = $this->request->query('term');

        if ($this->RequestHandler->isAjax()) {
            $conditions['or'][] = array('User.name LIKE' => "%$term%");
            $conditions['or'][] = array('User.username LIKE' => "%$term%");

            if ($excludeSelf == 'true') {
                $results = $this->User->find('all', array('conditions' => 'User.id != '. $this->Session->read('Auth.User.id'), 'fields' => 'User.id, User.name, User.username'));
            } else {
                $results = $this->User->find('all', array('fields' => 'User.id, User.name, User.username'));
            }
            foreach ($results as $result) {
                $answer[] = array(
                    "id"=>$result['User']['id'],
                    "text" => $result['User']['name'] . "(" . $result['User']['username'] . ")",
                    "name"=>$result['User']['name'],
                    "email" => $result['User']['username']
                );
            }

            $this->set('response', $answer);
            $this->render('/Elements/jsonraw');
        } else {
            $this->set('response', array());
            $this->render('/Elements/jsonraw');
        }
    }

    /*
     * deletes a user
     * input:
        REST parameters: userid
        Query Parameters: None
     * preconditions: the user is valid
     * postconditions: the user will be flagged as deleted
    */
    function delete($id = null) {
        $this->layout = false; 
        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        $user = $this->User->findById($id);
        
        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $user);

        if ($this->request->is('post')) {
            $this->User->id = $id;
            if ($this->User->saveField('isdeleted', true)) {
                $this->set('response', 'success');
                $this->set('data', array('userid' => $id));
                $this->render('/Elements/jsonreturn');
            } else {
                //non-ajax
                $this->set('response', 'failed');
                $this->set('data', array('userid' => $id));
                $this->render('/Elements/jsonreturn');
            }
        } 
    }
}