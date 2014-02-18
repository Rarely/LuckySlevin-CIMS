<?php 
class Comment extends AppModel {
    public $belongsTo = 'Idea';
    public $hasOne = 'User';
}
