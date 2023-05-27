<?php
    require_once "database.php";
    require_once "models/User.php";

    function handleLogin($username, $password, $user_model)
    {
        session_start();

        $user = $user_model->authenticateUser($username, $password);

        if ($user["user_id"]) 
        {
            $_SESSION["user_id"] = $user["user_id"];
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