<?php
        require "vendor/autoload.php";
    if(isset($_POST["login"], $_POST["password"]))
    {

        $db = new \Photos\DB();
        $user_id = $db->check_user($_POST["login"], $_POST["password"]);
        if ($user_id['id']) {

            session_start();
            $_SESSION["user_id"] = $user_id["id"];
            $_SESSION["user_name"] = $user_id["name"];
            header("Location: user.php");


        
        }
        else 
        {
            header("Location: user.php?error=login");
        }
    }
    // var_dump($user_id);