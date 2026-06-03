<?php 
session_start();
require_once 'core/database.php';
require_once 'app/models/User.php';
require_once 'app/models/Video.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/VideoController.php';
$database = new database();
$db_conn = $database->getConnection();


// Add objects from User and Controls
$userModel = new UserModel($db_conn);
$userController = new UserController($userModel);

$videoModel = new VideoModel($db_conn);
$videoController = new VideoController($videoModel);

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

switch ($action) {
    case 'register':
        //call the function from controls
        $userController->register();
        break;

    case 'login':
        $userController->login();
        break;
    
    case 'logout':
        $userController->logout();
        break;

    case 'upload':
        $videoController->upload();
        break;
    
    case 'delete_video': 
        $videoController->delete();
        break;

    case 'home':
        default: 
        echo"<h1>Welkom bij StreamHive </h1>";
        // if the user logged in of not
      if (isset($_SESSION['user_email'])) {
            echo "<p>Ingelogd als: <strong>" . $_SESSION['user_email'] . "</strong></p>";
            echo"<p><a href='index.php?action=upload'>Video uploaden</a></p>";
            echo "<a href='index.php?action=logout'>Uitloggen </a>";
        } else {
        echo "<a href='index.php? action=register'>Register(new account)</a> <br>";
        echo "<a href='index.php?action=login'>Inloggen</a>";
        }
        echo "<hr><h2>Beschikbare Video's</h2>";

        // bring videos from the contener
        $videos = $videoController->index();

        if (!empty($videos)){
            echo "<div style='border: 1px solid #ccc; padding: 15px; width: 320px; border-radius: 8px;'>";
            foreach($videos as $video){
                echo "<h3>" . htmlspecialchars($video['title']) . "</h3>";
                echo "<p>" . htmlspecialchars($video['description']) . "</p>";

              echo "<video width='300' controls>";
                echo "<source src='" . htmlspecialchars($video['filename']) . "' type='video/mp4'>";
                echo "Je browser ondersteunt deze video niet.";
                echo "</video>";

                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $video['user_id']) {

                    echo "<br><br>";

                    echo "<a href='index.php?action=delete_video&id=" . $video['id'] . "'style='color: red; font-weight: bold;' 

                             onclick='return confirm(\"Weet je zeker dat je deze video wilt verwijderen?\")'>Video Verwijderen </a>";
                }
                echo "</div>";

            }
            echo "</div>";
        } else {
            echo "<p>Er zijn nog geen video's geüpload. </p>";
        }

        break;
    
        
}

        