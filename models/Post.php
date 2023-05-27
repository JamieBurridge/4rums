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
                $query = "SELECT * from posts WHERE topic_id = :topic_id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(":topic_id", $topic_id);
                $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException)
            {
                return array("error" => "Oops! There was an error loading the posts");
            }
        }
    }

?>