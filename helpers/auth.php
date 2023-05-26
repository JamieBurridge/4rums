<?php
    require_once "database.php";
    require_once "models/User.php";

    function handleLogin($username, $password, $user_model, $error_message)
    {
        session_start();

        $user = $user_model->authenticateUser($username, $password);
    
        if ($user["username"]) 
        {
            $_SESSION["username"] = $user["username"];
            header("Location: /4rums/pages/board.php");
            exit();
        } 
        else 
        {
            $error_message = $user["error"];
            return array("error"=>$error_message);
        }
    }
?>