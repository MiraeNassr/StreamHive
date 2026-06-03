<?php

class VideoController {
    private $videoModel;
    public function __construct($videoModel)
    {
       $this->videoModel = $videoModel;
    }

    public function upload(){
     // session is start 
         if(session_status() === PHP_SESSION_NONE){
            session_start();
         }

         if(!isset($_SESSION['user_id'])){
            header("Location: index.php?action=login");
            exit();
        }

       

        if ($_SERVER['REQUEST_METHOD']== 'POST'){
            $title = $_POST['title'];
           $description = $_POST['description'];
            $user_id = $_SESSION['user_id'];

            $video_file = $_FILES['video_file'];
            $filename = time(). '_' .  $video_file['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . $filename;

            if(move_uploaded_file($video_file['tmp_name'], $target_file)){
                if ($this->videoModel->createVideo($title, $description, $target_file, $user_id)){
                    echo "Video is succesvol geupload!";
                    echo "<br><a href='index.php'>Terug naar home</a>";
                } else {
                    echo "Fout bij het opslaan in de database.";
                }
            } else {
                echo "Fout bij het uploaden van het bestand naar de map.";
            }
        } else {
          
            require_once './views/upload_video.php';
        }
    }

    public function index(){
        $videos = $this->videoModel->getAllVideos();
        return $videos;
    }
}
                
            