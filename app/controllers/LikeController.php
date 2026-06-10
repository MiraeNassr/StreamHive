<?php
class LikeController {
    private $likeModel;

    public function __construct($likeModel) {
        $this->likeModel = $likeModel;
    }

    public function toggleLike() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }
        // Must log in 
        if (isset($_GET['video_id'])) {
            $video_id = $_GET['video_id'];
            $user_id = $_SESSION['user_id'];

            //Prevent duplication in Model like
            $this->likeModel->addLike($video_id, $user_id);
            header("Location: index.php?action=watch&id=" . $video_id);
            exit();
        }
}
}