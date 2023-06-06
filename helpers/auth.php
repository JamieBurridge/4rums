<?php
    require_once "database.php";
    require_once "models/User.php";

    function handleLogin($username, $password, $user_model)
    {

        $user = $user_model->authenticateUser($username, $password);

        if ($user["user_id"])
        {
            header("Location: /pages/board.php");
            session_start();
            $_SESSION["user_id"] = $user["user_id"];
            exit();
        }
        else
        {
            $error_message = $user["error"];
            return array("error"=>$error_message);
        }
    }
?>