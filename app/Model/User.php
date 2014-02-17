<?php
class User extends AppModel {
    public $hasMany = array(
        'Notifications' => array('Notification' => 'Notification',
                            'className' => 'Notification',
                            'foreignKey' => 'userid',
                            'order' => 'Notifications.created DESC',
        )
    );
    public $validate = array(
        'email' => array(
            'rule'     => 'email',
            'required' => true,
            'message'  => 'Please enter a valid email address'
        ),
        'password' => array(
            'rule'    => array('between', 8, 32),
            'message' => 'Between 8 to 32 characters'
        ),
        'name' => array(
            'rule'    => array('maxlength', 64),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Name is too long, must not exceed 64 characters.'

        ),
        'role' => array(
            'rule'    => array('maxlength', 64),
            'required' => true,
            'allowEmpty' => false,
            'message' => 'HEY BITCH'
        )
    );
}
?>
