<?php 

class VideoModel {
    private $db;
    private $table = "videos";


    public function __construct($db_connection) {
        $this->db = $db_connection;
    }

    //function for bring all the videos with the users name
    public function getAllVideos(){
        // this is to know wich user push it the video
        $query = "SELECT videos.*, users.email 
                  FROM " . $this->table . " 
                  JOIN users ON videos.user_id = users.id 
                  ORDER BY videos.created_at DESC";// DESC it to show the videos from new to old

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    public function createVideo($title, $description, $filename, $user_id) {
        $query = "INSERT INTO " . $this->table . " (user_id, title, description, filename) VALUES (:user_id, :title, :description, :filename)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':filename', $filename);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}