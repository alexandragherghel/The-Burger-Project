<?php


class Users
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }


    public function updateUsersName($email = null,$name, $table = 'users'){
        if($email != null){
            $result = $this->db->con->query(" UPDATE {$table} SET username = {$name}
                WHERE email={$email};");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    public function updateUsersBirthday($email = null,$data, $table = 'users'){
        if($email != null){
            $result = $this->db->con->query(" UPDATE {$table} SET birthday = {$data}
                WHERE email={$email};");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }
    public function updateUsersGender($email = null,$gen, $table = 'users'){
        if($email != null){
            echo "avem email";
            $result = $this->db->con->query(" UPDATE {$table} SET gender = {$gen}
                WHERE email={$email};");
            print_r(" UPDATE {$table} SET gender = {$gen}
                WHERE email={$email};");
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }else{
                echo "nu avem result";
            }
            return $result;
        }
    }
}