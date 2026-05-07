<?php 

require_once 'core/database.php';
require_once 'app/models/User.php';

$database = new Database();
$db_conn = $database->getConnection();

// Add copy from the model and pass it to connection
$userModel = new UserModel($db_conn);
if ($userModel->createUser('Nassr@gmail.com', '123456', 'admin')) {
    echo "<br> the user add it well";
    } else {
        echo"error can niet add the user";
    }
$users = $userModel->getAllUsers();

echo "<pre>";
print_r($users);
echo "</pre>";