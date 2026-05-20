<?php 
session_start();
require_once 'core/database.php';
require_once 'app/models/User.php';
require_once 'app/models/Video.php';
require_once 'app/controllers/UserController.php';

$database = new database();
$db_conn = $database->getConnection();


// Add objects from User and Controls
$userModel = new UserModel($db_conn);
$userController = new UserController($userModel);

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

    case 'home':
        default: 
        echo"<h1>Welkom in StreamHive </h1>";
        // if the user logged in of not
      if (isset($_SESSION['user_email'])) {
            echo "<p>Ingelogd als: <strong>" . $_SESSION['user_email'] . "</strong></p>";
            echo "<a href='index.php?action=logout'>Uitloggen </a>";
        } else {
        echo "<a href='index.php? action=register'>Register(new account)</a> <br>";
        echo "<a href='index.php?action=login'>Inloggen</a>";
        }
        break;
}
        