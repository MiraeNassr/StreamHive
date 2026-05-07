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
}