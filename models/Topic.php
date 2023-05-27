<?php
    class Topic 
    {
        private $db;
        private $topics_error_message = "Oops! There has been an error loading the topics.";

        public function __construct($db)
        {
            $this->db = $db;
        }

        public function getTopics()
        {
            try
            {
                $query = "SELECT * FROM topics";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $error)
            {
                return array("error" => $this->topics_error_message);
            }
        }
    }
?>