<?php 
class Tracking extends AppModel {
    public $belongsTo = array('User', 'Idea');
}
