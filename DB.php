<?php
namespace Photos;
use mysqli;

class DB {
    static $host = "localhost";
    static $user = "root";
    static $password = "";
    static $database ="photos";
    static $name = '';
    public $link;

    public function __construct(){
        $this->link = new mySqli(DB::$host,DB::$user, DB::$password, DB::$database);
       $this->link->set_charset("utf8");
    }

    public function get_all_photos() {
        $sql_result = $this->link->query("SELECT * FROM `photos` ORDER BY 'id' DESC");
        if ($sql_result->num_rows) {
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        }
        return[];
        // return $this->link->query("SELECT * FROM `photos`")->fetch_all(MYSQLI_ASSOC);
    }

    public function get_user_photos($uid) {
        $sql_result = $this->link->query(" SELECT * FROM `photos` WHERE `Uid` = $uid ORDER BY 'id' DESC");
        if ($sql_result->num_rows) {
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        }
        return[];
        // return $this->link->query("SELECT * FROM `photos`")->fetch_all(MYSQLI_ASSOC);
    }

    public function check_user($login, $password) {
        $sql_result = $this->link->query("SELECT * FROM `users` WHERE `email` = '$login' AND `password` = '$password'");
        if ($sql_result->num_rows){
            $user = $sql_result->fetch_assoc();
            return ['id'=>$user["id"], 'name'=>$user["name"]];
            
        }
        return[];
    }
    // // public function galery_user($login) {
    // //     $sql_result = $this->link->query("SELECT * FROM `users` WHERE `email` = '$login'");
    // //     if ($sql_result->num_rows){
    // //         $user = $sql_result->fetch_assoc();
    // //         return $user["email"];
    // //     }
    // //     return[];
    // }
    public function check_login ($login) {
        $sql_result = $this->link->query("SELECT * FROM `users` WHERE `email` = '$login'");
        if ($sql_result->num_rows){
            return true;
        }
        return false;
    }
    
    public function new_user($login, $password, $name) {
        $this->link->query("INSERT INTO`users`(name, password, email) VALUES('$name', '$password', '$login')");
    }
    public function new_photo($uid, $image, $text) {
        $this->link->query("INSERT INTO`photos`(uid, image, text, tags) VALUES($uid, '$image', '$text', '')");
    }


    public function get_photo_by_id($photo_id) {
        $sql_result = $this->link->query(
                                            "SELECT `p`.*, `u`. `name` FROM `photos` `p` LEFT JOIN `users` `u` on `u`.`id` = `p`.`uid` WHERE `p`.`id` = '$photo_id'"
                                        );
        if ($sql_result->num_rows) {
            return $sql_result->fetch_assoc();
        }
        return false;
    }
    public function get_photo_comments($photo_id){
        $sql_result = $this->link->query(
                                            "SELECT `c`.*, `u`. `name` FROM `comments` `c` LEFT JOIN `users` `u` on `u`.`id` = `c`.`uid` 
                                            WHERE `c`.`pid` = '$photo_id' ORDER BY 'id' DESC"
                                        );
        if($sql_result->num_rows)
        {
            return $sql_result->fetch_all(MYSQLI_ASSOC);
        }
        return [];
    }
    public function add_comment($pid,$uid,$text) {
        $date = date("Y-m-d");
        $this->link->query("INSERT INTO `comments`(pid, uid, text, `post date`) VALUES ('$pid','$uid','$text','$date')");
        $last_id = $this->link->insert_id;
        $inserted_comment = $this->link->query(
                                         "SELECT `c`.*, `u`. `name` FROM `comments` `c` LEFT JOIN `users` `u` on `u`.`id` = `c`.`uid` WHERE `c`.`id` = '$last_id'"
                                        );
        return $inserted_comment->fetch_assoc();
    }
}
