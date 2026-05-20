<?php

class UserController {
 private $userModel;

 public function __construct($userModel){
  
    $this->userModel = $userModel;
 }
 public function register() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($this->userModel->register($email, $password)){
            echo "Registration successful";
        }else{
            echo "Error in register";
        }
    }else{
        require_once './views/register.php';

    }
        }

       public function login() {
        if($_SERVER['REQUEST_METHOD']== 'POST'){
            $email =$_POST['email'];
            $password= $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if ($user){
                // save the user data
               
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role'] = $user['role'];
                header("Location: index.php");
                exit();
            }else{
                echo "Onjuiste email of wachtwoord.";
            }
        }else{
            require_once './views/login.php';
        }
       }

       public function logout(){
            if (session_status() === PHP_SESSION_NONE){
                session_start();
            }
            // delete all data
            $_SESSION = array();
            session_destroy();

            //send the user to the home page
            header("location: index.php");
            exit();
       }
    }
 