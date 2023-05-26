<?php 
    namespace User;
    
    function getUsername() {
        session_start();

        $username = null;
    
        if (isset($_SESSION["username"])) {
            $username = $_SESSION["username"];
            return $username;
        } else {
            // If user is not logged in redirect to login page
            header("Location: /4rums/index.php");
        }
    }
?>
