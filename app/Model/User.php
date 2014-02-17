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
            'email' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Please enter a valid email address'
            )
        ),
        'password' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphanumeric characters only.'
            ),
            'between' => array(
                'rule'    => array('between', 8, 32),
                'message' => 'Between 8 to 32 characters'
            )
        ),
        'name' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphanumeric characters only.'
            ),
            'between' => array(
                'rule'    => array('between', 1, 64),
                'message' => 'Between 1 to 64 characters'
            )
        ),
    );
}
?>
