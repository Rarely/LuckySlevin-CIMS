<?php
App::uses('AppController', 'Controller');
class NotificationsController extends AppController {
    public $helpers = array('Html', 'Form');
    var $components = array('RequestHandler');

   /*
     * Renders the list of notifications
     * input:
        REST parameters: None
        Query Parameters: None
     * preconditions: A user is logged in
     * postconditions:  A view with the list of notifications for the currently logged in user is returned
    */
    public function index() {
        $this->set('title_for_layout', 'Notifications');
        $this->set('notifications', $this->Notification->find('all', array(
            'conditions' => array('Notification.userid' => $this->Session->read('Auth.User.id')),
            'order' => array('Notification.isread ASC', 'Notification.created DESC'),
            'limit' => 50,
        )));
    }

    /*
     * Reads a notification
     * input:
        REST parameters: notification id
        Query Parameters: None
     * preconditions: the notification id is valid
     * postconditions:  Marks the notification as read
    */
    public function notified($id = null) {
        $this->layout = null; //disable layout for json return
        if ($this->RequestHandler->isAjax()) {
            if(!$id) {
                $id = @$this->request->query('id');
            }
            if (!$id || !is_numeric($id)) {
                throw new NotFoundException(__('No id'));
            } 
            $this->Notification->read(null, $id);
            $this->Notification->set('isread', 1);
            if ($this->Notification->save()) {
                $this->set('response', 'success');
                $this->set('data', $id);
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response', 'failed');
                $this->set('data', $id);
                $this->render('/Elements/jsonreturn');
            }
        } else {
            //non-ajax
            $this->set('response', 'failed');
            $this->set('data', $id);
            $this->render('/Elements/jsonreturn');
        }
    }

    /*
     * Helper function to send notifications to users
     * input:
        parameters: title: the title of the notification
                    message: the subtitle of the notification
                    ideaid (required): the idea to link the notification to
                    userid: a specific user to notify
                    senderid: the user who is initiating the notifications
        Query Parameters: None
     * preconditions: all data is valid
     * postconditions: The owner of an idea, the user, and the tracking users are notified
    */
    public function sendNotifications($title, $message, $ideaid = null, $userid = null, $senderid = null) {
        $response = true;
        if ($ideaid != null && $message != null && $title != null) {
            if ($userid != null && $userid != $senderid) {
                //send to individual user
                $notification = $this->Notification->create();
                $notification['Notification']['userid'] = $userid;
                $notification['Notification']['ideaid'] = $ideaid;
                $notification['Notification']['title'] = $title;
                $notification['Notification']['message'] = $message;
                $notification['Notification']['created'] = null; //!important
                if (!$this->Notification->save($notification)) {
                    $response = false;
                }
            }
            
            //send to all tracking users
            $trackingids = $this->Tracking->find('all', array(
                'Idea.isdeleted' => 0
                ,'conditions' => array('Tracking.ideaid' => $ideaid)
            ));
            foreach ($trackingids as $user) {
                //check if self or owner (owner already has been notified)
                if ($user['Tracking']['userid'] != $senderid && $userid != $senderid && $user['Tracking']['userid'] != $userid) {
                    $notification = $this->Notification->create();
                    $notification['Notification']['userid'] = $user['Tracking']['userid'];
                    $notification['Notification']['ideaid'] = $ideaid;
                    $notification['Notification']['title'] = $title;
                    $notification['Notification']['message'] = $message;
                    $notification['Notification']['created'] = null; //!important
                    if (!$this->Notification->save($notification)) {
                        $response = false;
                    }
                }
            }
        } else {
            $response = false;
        }
        return $response;
    }
}