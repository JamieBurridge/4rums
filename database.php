<?php
    $host = "database";
    $port = "3306";
    $user = "dev";
    $password = "dev1234";
    $dbname = "4rums";

    $dsn = "mysql:host=" .$host. ";port=" .$port. ";dbname=" .$dbname. ";charset=utf8mb4";

    $options = [
        PDO::ATTR_EMULATE_PREPARES   => false, // Disable emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Disable errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Make the default fetch be an associative array
    ];

    try
    {
        $conn = new PDO($dsn, $user, $password, $options);
    }
    catch (Exception $e)
    {
        error_log($e->getMessage());
        exit('Something bad happened');
    }
?>