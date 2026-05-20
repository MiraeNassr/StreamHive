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
                echo "Inloggen succesvol! Welkom" . $user['email'];
            }else{
                echo "Onjuiste email of wachtwoord.";
            }
        }else{
            require_once 'app/views/login.php';
        }
       }
    }
 