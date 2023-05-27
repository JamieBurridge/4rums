<?php
    function convertDateTime($datetime)
    {
        $convertedDateTime = new DateTime($datetime);
        return $convertedDateTime->format("H:i d/m/Y");
    }
?>