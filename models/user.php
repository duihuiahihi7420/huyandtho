<?php
class User extends Db{
    //Lấy name 
    public function getUserByUsername($username){
        $sql = self::$connection->prepare("SELECT * FROM users WHERE user_name='$username'");
        // $sql->bind_param('s',$username);
        return $this->select($sql);
    }
    //Lấy ID
    public function getUserById($id){
        $sql = self::$connection->prepare("SELECT * FROM users WHERE user_id='$id'");
        return $this->select($sql);
    }
    //Lấy danh sách User
    public function getAllUser(){
        $sql = self::$connection->prepare("SELECT * FROM users");
        return $this->select($sql);
    }

    //Dùng để chỉnh sửa
    public function getUserIdByUserName($username){
        $sql = self::$connection->prepare("SELECT * FROM users WHERE user_name ='$username'");
        $user = $this->select($sql);
        foreach ($user as $key => $value) {
            return $value['id'];
        }
    }
}