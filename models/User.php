<?php

class User
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createUser($username, $password)
    {
        try 
        {
            $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
            $stmt->execute();
        }
        catch (PDOException $error)
        {
            return array("error"=> "Oops! There was an error creating your account"); 
        }
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function authenticateUser($username, $password) 
    {
        try 
        {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
    
            $response = $stmt->fetch();

            if ($response) 
            {
                $hashedPassword = $response["password"];

                if (password_verify($password, $hashedPassword))
                {
                    return array("username" => $username, "error" => null);
                }

                return array("username" => null, "error" => "Oops, there was a problem logging in!");
            }
        }
        catch (PDOException $error)
        {
            return array("username" => null, "error" => "Oops, there has been an error!");
        }
    }
}

?>