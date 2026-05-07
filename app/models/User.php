<?php 

class UserModel {
    private $db;
    private $table = "users";

   
// connection with database 
    public function __construct($db_connection) {
        $this->db = $db_connection;
    }

    // function for bring all the users in users table
    // (prpare and execute) Prevent anyone from using malicious SQL code on the site(securety)
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->db->prpare($query);
        $stmt->execute();
   
    // objecgt to bring the data in database
    return $stmt->fetchAll();
    }
}