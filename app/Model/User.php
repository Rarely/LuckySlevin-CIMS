<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $hasMany = array(
        'Notifications' => array('Notification' => 'Notification'
                            ,'className' => 'Notification'
                            ,'foreignKey' => 'userid'
                            ,'order' => 'Notifications.created DESC'
        ),
        'Trackings' => array('Tracking' => 'Tracking'
                            ,'className' => 'Tracking'
                            ,'foreignKey' => 'userid'
        )
    );
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A name is required'
            )
        ),
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            ),
            'email' => array(
                'rule' => array('email'),
                'message' => 'Username must be a valid email address'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'This email is already in use.'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
            'length' => array(
                'rule' => array('between',8,32),
                'message' => 'Passwords must be between 8 and 32 characters in length.'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'standard')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}
