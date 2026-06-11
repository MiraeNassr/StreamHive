<?php
class LikeModel {
    private $db;
    private $table = "likes";

    public function __construct($db_connection) {
        $this->db = $db_connection;
    }
    // provent doubel likes
    public function addLike($video_id, $user_id) {
        $query = "INSERT IGNORE INTO " . $this->table . " (video_id, user_id) VALUES (:video_id, :user_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':video_id', $video_id);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }
    //Total number of likes count
    public function getLikeCount($video_id) {
        $query = "SELECT COUNT(*) as total_likes FROM " . $this->table . " WHERE video_id = :video_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':video_id', $video_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_likes'];
    }

    //Chech if the current user has previously liked this video
    public function hasUserLiked($video_id, $user_id) {
        $query = "SELECT id FROM " . $this->table . " WHERE video_id = :video_id AND user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':video_id', $video_id);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->rowCount() > 0;
        }

        public function removeLike($video_id, $user_id) {
    $query = "DELETE FROM " . $this->table . " WHERE video_id = :video_id AND user_id = :user_id";
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':video_id', $video_id);
    $stmt->bindParam(':user_id', $user_id);
    return $stmt->execute();
}
}