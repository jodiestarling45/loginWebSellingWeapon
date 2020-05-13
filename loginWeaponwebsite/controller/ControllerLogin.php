<?php

namespace controller;

use model\user_password;
use model\DBConnection;
use model\DBLogin;

class ControllerLogin
{
    public $DBConnectionLogin;

    public function __construct()
    {
        $connection = new DBConnection('mysql:host=localhost;dbname=weapondatabase', 'admin', '123456');
        $this->DBConnectionLogin = new DBLogin($connection->connection());
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $result = $this->DBConnectionLogin->checkLogin($_POST['email']);
            if ($result){
                header('location: view/main.php');
            }else{
                $message = "wrong password or account";
            }
        }


        include 'view/loginpage.php';

    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"]=="POST"){
            $user = new user_password($_POST['email'],$_POST['password'],$_POST['name'],$_POST['address'],$_POST['phone']);
            $this->DBConnectionLogin->register($user);
            header('location: view/loginpage.php');

        }
        include 'view/register.php';


    }
}