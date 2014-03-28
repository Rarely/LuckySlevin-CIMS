<?php
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
            if (!$id) {
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
        if ($ideaid != null && $userid != null && $userid != $senderid) {
            //send to individual user
            $notification = $this->Notification->create();
            $notification['Notification']['userid'] = $userid;
            $notification['Notification']['ideaid'] = $ideaid;
            $notification['Notification']['title'] = $title;
            $notification['Notification']['message'] = $message;
            $notification['Notification']['created'] = null; //!important
            if ($this->Notification->save($notification)) {
                //Good input
            } else {

            }
        }
        if ($ideaid != null) {
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
                    if ($this->Notification->save($notification)) {
                        //Good input
                    } else {

                    }
                }
            }
        }
    }

    /*
     * !!DEPRECATED!!
     * Notifies the designated idea's users
     * url example: http://www.cims.com/notifications/notify/<<IDEA ID>>?userid=USER ID&m=<<TEXT FOR NOTIFICATION>>
    */
    /*
        1. check to see if user param is given, then only send to that user, otherwise, send to all tracking users
        2. grab all tracking users
        3. for each tracking user, create a notification and save to db, add errors to an array
        4. check error array and return appropriate response in JSON.
    */
    public function notify($id = null) {
        $userid = null;
        $this->layout = null;
        if ($this->RequestHandler->isAjax()) {
            if(!$id) {
                $id = @$this->request->query('id');
            }
            if (!$id) {
                throw new NotFoundException(__('No id'));
            } 

            $errors = array();
            $message = @$this->request->query('m');
            
            //CHECK FOR MESSAGE NOT NULL
            if ($message == null || $message == "") {
                throw new NotFoundException(__('No message'));
            }

            //check for userid
            $userid = @$this->request->query('userid');
            $userids = array();
            if ($userid != null) {
                array_push($userids, $userid);
            } else {
                //iterate through trackings
                $trackingids = $this->Tracking->find('all', array(
                    'conditions' => array('Tracking.ideaid' => $id)
                ));
                foreach ($trackingids as $user) {
                    //check if self
                    if ($user['Tracking']['userid'] != $this->Session->read('Auth.User.id')) {
                        array_push($userids, $user['Tracking']['userid']);
                    }
                }
            }
            //check if current user is in the array and remove them
            if (in_array($userid, $userids)) {
                //unset ....
            }
            //iterate through tracking id's
            foreach ($userids as $user) {
                //echo $user;
                $notification = $this->Notification->create();
                $notification['Notification']['userid'] = $user;
                $notification['Notification']['ideaid'] = $id;
                $notification['Notification']['message'] = $message;
                $notification['Notification']['created'] = null; //!important
                if ($this->Notification->save($notification)) {
                    //Good input
                } else {
                    //add user id to errors
                    array_push($errors, $user);
                }
            }

            //check for errors and send appropriate response
            if (count($errors) > 0) {
                $this->set('response', 'failed');
                $this->set('data', $errors);
                $this->render('/Elements/jsonreturn');
            } else {
                $this->set('response', 'success');
                $this->set('data', array('userid' => $id));
                $this->render('/Elements/jsonreturn');
            }    
        } else {
            //non-ajax
            $this->set('response', 'failed');
            $this->set('data', array('userid' => $id));
            $this->render('/Elements/jsonreturn');
        }
    }
}