<?php 

require_once 'core/database.php';
require_once 'app/models/User.php';
require_once 'app/models/Video.php';
require_once 'app/controllers/UserController.php';

$database = new Database();
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

    case 'home':
        default: echo"<h1>Welcome in StreamHive </h1>";
        echo "<a href='index.php? action=register'>Register(new account)</a>";
        break;
}