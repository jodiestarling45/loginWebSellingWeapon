<?php


namespace model;


class DBLogin
{
    public $connection;
    public function __construct($connection)
    {
        $this->connection=$connection;
    }
    public function checkLogin($username){
        $sql="SELECT * FROM `user_password` WHERE email='$username'";
        $stmt = $this->connection->query($sql);
        $result = $stmt->fetch();
        return $result;
    }
    public function register($user){
        $sql = "INSERT INTO `user_password`( `name`, `email`, `password`, `address`, `phone`) VALUES ('$user->name','$user->email','$user->password','$user->address','$user->phone')";
        $this->connection->exec($sql);
    }

}