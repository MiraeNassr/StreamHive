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
        $query = "SELECT * FROM videos ORDER BY id DESC" ;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // return the videos like an array
    }

   public function createVideo($title, $description, $filename, $user_id) {
        $query = "INSERT INTO " . $this->table . " (title, description, filename, user_id) 
                  VALUES (:title, :description, :filename, :user_id)";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':filename', $filename);
        $stmt->bindParam(':user_id', $user_id);

        return $stmt->execute();
   }

   public function getVideoById($id) {
    $query = "SELECT * FROM videos WHERE id = :id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function getRelatedVideos($current_id) {
    $query = "SELECT * FROM videos WHERE id != :current_id ORDER BY id DESC LIMIT 4";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':current_id', $current_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

   public function deleteVideo($video_id, $user_id) {
   $query = "DELETE FROM videos WHERE id = :video_id AND user_id = :user_id";
    
    $stmt = $this->db->prepare($query);
    
    $stmt->bindParam(':video_id', $video_id);
    $stmt->bindParam(':user_id', $user_id);
    
    return $stmt->execute();

   }
}