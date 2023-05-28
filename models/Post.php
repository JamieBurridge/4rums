<?php
    class Post 
    {
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function getTopicPosts($topic_id)
        {
            try 
            {
                $query = "SELECT * from posts WHERE topic_id = :topic_id ORDER BY created_at DESC";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":topic_id", $topic_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $error)
            {
                return array("error" => "Oops! There was an error loading the posts.");
            }
        }

        public function getSinglePost($id)
        {
            try
            {
                $query = "SELECT * FROM posts WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":id", $id);
                $stmt->execute();

                return $stmt->fetch(PDO::FETCH_ASSOC);
            }
            catch (PDOException $error)
            {
                return array("error" => "Oops! There was an error loading the post.");
            }
        }

        public function createPost($user_id, $topic_id, $subject, $content)
        {
            try 
            {
                $query = "INSERT INTO posts (user_id, topic_id, subject, content) VALUES (:user_id, :topic_id, :subject, :content)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":user_id", $user_id);
                $stmt->bindParam(":topic_id", $topic_id);
                $stmt->bindParam(":subject", $subject);
                $stmt->bindParam(":content", $content);
                $stmt->execute();
            }
            catch (PDOException $error)
            {
                return array("error" => "Oops! There was an error creating your post.");
            }

        }
    }

?>