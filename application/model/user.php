<?php
/**
 * Created by PhpStorm.
 * User: tim
 * Date: 27.03.17
 * Time: 10:46
 */

class User extends Model
{
    public $id;
    public $name;
    public $password;
    public $user_hash;

    public static function getUserByLogin($login, $connect){
        $sql = "SELECT * FROM users where name =:login";
        $query = $connect->prepare($sql);
        $parameters = [':login' => $login];
        $query->execute($parameters);
        return $query->fetch();
    }

    public static function getUserById($id, $connect){
        $sql = "SELECT * FROM users where id =:id";
        $query = $connect->prepare($sql);
        $parameters = [':id' => $id];
        $query->execute($parameters);
        return $query->fetch();
    }

    public static function setNewHashById($hash, $id, $connect){
        $sql = "UPDATE users SET user_hash=:hash WHERE id=:id";
        $query = $connect->prepare($sql);
        $parameters = [':id' => $id, ':hash' => $hash];
        $query->execute($parameters);
    }

    public static function createNewUser($login, $password, $connect){
        $sql = "INSERT INTO users (name, password, user_hash) VALUES (:name, :password, :hash)";
        $hash = md5(Helper::generateCode(10));
        $query = $connect->prepare($sql);
        $password = md5(md5($password));
        $parameters = [':name' => $login, ':hash' => $hash, ':password'=>$password];
        if($query->execute($parameters)){
            $user = User::getUserByLogin($login, $connect);
            setcookie("id", $user->id, time()+60*60*24*30, '/');
            setcookie("hash", $hash, time()+60*60*24*30, '/');
            return true;
        }else{
            return false;
        }
    }
}