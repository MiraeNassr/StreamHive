<?php 

require_once 'core/database.php';
require_once ' app/models/User.php';

$database = new Database();
$db_conn = $database->getConnection();

// Add copy from the model and pass it to connection
$userModel = new UserModel($db_conn);
$users = $userModel->getAllUsers();

echo "<pre>";
print_r($users);
echo "</pre>";