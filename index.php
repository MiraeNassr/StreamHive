<?php 

require_once 'core/database.php';
require_once 'app/models/User.php';
require_once 'app/models/Video.php';

$database = new Database();
$db_conn = $database->getConnection();


// Add copy from the model and pass it to connection
$userModel = new UserModel($db_conn);
$videoModel = new VideoModel($db_conn);
/*if ($userModel->createUser('Nassr@gmail.com', '123456', 'admin')) {
    echo "<br> the user add it well";
    } else {
        echo"error can niet add the user";
    }*/

// For FK integrity (videos.user_id -> users.id), we must insert the video with an existing user_id.
// Use an existing user if present; otherwise try to create one.
$user = $userModel->getAllUsers();
$existingUserId = null;

if (!empty($user)) {
    $existingUserId = $user[0]->id;
} else {
    // If the DB is empty, create a user (may fail if the email already exists).
    try {
        $userModel->createUser('nassr@gmail.com', '123456', 'admin');
    } catch (Exception $e) {
        // ignore and re-fetch users
    }
    $user = $userModel->getAllUsers();
    if (!empty($user)) {
        $existingUserId = $user[0]->id;
    }
}

if ($existingUserId !== null && $videoModel->createVideo('The Rock', 'Best Action Movie Moments', 'Action', $existingUserId)) {
    echo "<br> video added well";
} else {
    echo"error cannot add the video";
}


$users = $userModel->getAllUsers();
$videos = $videoModel->getAllVideos();
echo "<pre>";
print_r($users);
echo "</pre>";