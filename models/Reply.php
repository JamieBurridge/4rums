<?php
    class Reply
    {
        private $db;

        function __construct($db)
        {
            $this->db = $db;
        }

        function getPostReplies($post_id)
        {
            try 
            {
                $query = "SELECT * FROM replies WHERE post_id = :post_id ORDER BY created_at DESC";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":post_id", $post_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $error)
            {
                return array("error" => "Oops! There was an error loading the replies");
            }
        }

        function createReply($user_id, $post_id, $content)
        {
            try 
            {
                $query = "INSERT INTO replies (user_id, post_id, content) VALUES (:user_id, :post_id, :content)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":user_id", $user_id);
                $stmt->bindParam(":post_id", $post_id);
                $stmt->bindParam(":content", $content);
                $stmt->execute();
            }
            catch (PDOException $error)
            {
                return array("error" => "Oops! There was an error replying.");
            }
        }
    }
?>