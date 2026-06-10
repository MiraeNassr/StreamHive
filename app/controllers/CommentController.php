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
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_text'])) {
            $video_id = $_POST['video_id'];
            $user_id = $_SESSION['user_id'];
            $comment_text = trim($_POST['comment_text']);

            if (!empty($comment_text)) {
                $this->commentModel->addComment($video_id, $user_id, $comment_text);
            }
            // return to homepage
            header("Location: index.php?action=watch&id=" . $video_id);
            exit();

    }    

    
}
}