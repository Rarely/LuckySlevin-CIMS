<?php
class Category extends AppModel {
    public $hasMany = array('Value' => array(
                           'className' => 'Value'
                           ,'foreignKey' => 'categoryid'
                        ));
    public $validate = array(

    );
}
?>
