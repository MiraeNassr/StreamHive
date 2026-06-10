<?php
class LikeModel {
    private $db;
    private $table = "likes";

    public function __construct($db) {
        $this->db = $db;
    }
}