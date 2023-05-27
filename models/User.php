<?php

class User
{
    private $db;
    private $login_error_message = "Oops, there was a problem logging in!";
    private $signup_error_message = "Oops! There was an error creating your account.";

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
            return array("error" => $this->signup_error_message); 
        }
    }

    public function getUsers()
    {
        $query = "SELECT username FROM users";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSingleUser($id)
    {
        $query = "SELECT id, username FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function authenticateUser($username, $password) 
    {
        try 
        {
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
    
            $response = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($response) 
            {
                $hashedPassword = $response["password"];

                if (password_verify($password, $hashedPassword))
                {
                    return array("username" => $username, "error" => null);
                }

                return array("username" => null, "error" => $this->login_error_message);
            }

            return array("username" => null, "error" => $this->login_error_message);
        }
        catch (PDOException $error)
        {
            return array("username" => null, "error" => $this->login_error_message);
        }
    }
}

?>