<?php
    function removeConsecutiveLineBreaks($text)
    {
          // Split text into paragraphs
          $paragraphs = explode("\n", $text);

          // Filter out empty paragraphs
          $paragraphs = array_filter($paragraphs, function($paragraph) {
              return trim($paragraph) !== '';
          });
  
          // Rejoin paragraphs with line breaks
          $text = implode("\n", $paragraphs);
          return $text;
    }
?>