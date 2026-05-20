<?php 

class UserModel {
    private $db;
    private $table = "users";

   
// connection with database 
    public function __construct($db_connection) {
        $this->db = $db_connection;
    }

    // function for bring all the users in users table
    // (prepare and execute) Prevent anyone from using malicious SQL code on the site(securety)
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();
   
    // objecgt to bring the data in database
    return $stmt->fetchAll();
    }

    public function register($email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO " . $this->table . " (email, password, role) VALUES (:email, :password, :role)";
        
    
    $stmt = $this->db->prepare($query);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':role', $role);

    if($stmt->execute()) {
        return true;
    }
    return false;
    }

    public function login($email, $password){
        $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
    
    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }
    return false;
    }
    

}