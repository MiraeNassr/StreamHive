<?php

class CommentModel {
    private $db;
    private $table = "comments";

    public function __construct($db) {
        $this->db = $db;
    }
//function to save the comments in database
    public function addComment($video_id, $user_id, $comment_text) {
        $query = "INSERT INTO " . $this->table . " (video_id, user_id, comment_text) 
                  VALUES (:video_id, :user_id, :comment_text)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':video_id', $video_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':comment_text', $comment_text);
        
        return $stmt->execute();
    }

    // function to cupel the user with his comment

    public function getCommentsByVideoId($video_id) {
        $query = "SELECT c.*, u.email FROM " . $this->table . " c 
                  JOIN users u ON c.user_id = u.id 
                  WHERE c.video_id = :video_id 
                  ORDER BY c.created_at DESC";
                  
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':video_id', $video_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}