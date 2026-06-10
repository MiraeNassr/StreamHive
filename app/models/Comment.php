<?php

class CommentModel {
    private $db;
    private $table = "comments";

    public function __construct($db) {
        $this->db = $db;
    }
}