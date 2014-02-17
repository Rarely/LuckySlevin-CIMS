<?php
class Category extends AppModel {
    public $hasMany = array(
            'Values' => array('Value' => 'Value'
                                ,'className' => 'Value'
                                ,'foreignKey' => 'categoryid'
            )
        );
    public $validate = array(

    );
}
?>
