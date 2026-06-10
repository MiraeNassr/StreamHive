<?php
class CommentController {
private $commentModel;

public function __construct($commentModel) {
$this->commentModel = $commentModel;
}
//Add new comment
public function store() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

    }    
}