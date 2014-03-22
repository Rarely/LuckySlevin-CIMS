<?php 
// app/Controller/UsersController.php

class UsersController extends AppController {
    var $uses =array('User','Ticket', 'CakeEmail', 'Network/Email');
    var $helpers = array('Html', 'Form');
    var $components =array('Email','Ticketmaster', 'RequestHandler');
    
    public function index() {
        $this->set('title_for_layout', 'Users');
        $this->set('users', $this->User->find('all', array( 
            'conditions' => array('User.isdeleted' => 0)
        )));
    }
    
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
            $this->User->read(null, $id);
            $this->User->set('name', $this->request->data['User']['name']);
            $this->User->set('email', $this->request->data['User']['username']);
            $this->User->set('password', $this->request->data['User']['password']);
            $this->User->set('role', $this->request->data['User']['role']);
            $this->User->set('updated', null);
             if ($this->User->save()) {
                 $this->Session->setFlash(__('User has been saved.'));
                 return $this->redirect(array('action' => 'index'));
             }
             $this->Session->setFlash(__('Unable to update a user.'));
        } 

    }

    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->User->set('password', 'temporary');
            if ($this->User->save($this->request->data)) {
                //issue reset password
                $this->resetpassword($this->request->data['User']['username']);
                $this->Session->setFlash(__('User has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add user.'));
        }
    }

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('logout','resetpassword','useticket', 'newpassword', 'memberslist');
        $this->Auth->authorize = array('Controller');
    }   

    public function login() {
        $this->layout= false;
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    function resetpassword($email=null){
        $this->layout = false;
        if(empty($this->request->data)){
            $this->request->data['User']['email']=$email;
            //show form
        }else{
            //already entered email
            if(!$email) $email=$this->request->data['User']['email'];
            // make sure whave email and a check
            if(!$email){
                $this->User->invalidate('email');
            }else{
                //email entered, check for it
                $account=$this->User->findByUsername($email);

                if(!isset($account['User']['username'])){
                    $this->Session->setFlash('If you have provided a valid email address, you will receive further password reset instructions shortly');
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
                    $this->Session->setFlash('An email has been sent with instructions to reset your password');
                    $this->redirect('/');
                }else{
                    $this->Session->setFlash('Ticket could not be issued');
                    $this->redirect('/');

                }
            }
 
        }
    }
 
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
            $this->Session->setFlash('Your ticket is lost or expired.');
            $this->redirect('/');
        }
 
    }
 
 
    function newpassword($id = null) {
        $this->layout = false;
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
            $data = array('id' => $this->request->params['pass'][0], 'password' => $this->request->data['User']['password']);
            if ($this->User->save($data)) {
                //delkete session token and dlete used ticket from table
                $this->Session->delete('tokenreset');
                $this->Session->setFlash('The User\'s Password has been updated');
                $this->redirect('/');
            } else {
                $this->Session->setFlash('Please correct errors below.');
            }
        }
    }

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