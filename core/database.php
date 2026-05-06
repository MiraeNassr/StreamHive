<?php 
class database {
    private $host = "localhost";
    private $db_name = "streamhive_db";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try{
             $this->conn = new PDO(
                "mysql: host=" . $this-> host . ";dbname=". $this->db_name, 
                $this-> username,
                $this-> password
             );
             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        }catch(PDOException $exception) {
            echo "connection error" . $exception->getMessage();
    }
      return $this->conn;
    }
};