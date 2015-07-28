<?php

    // Redirect the Page
    function logged_in_redirect() {
        if(logged_in() === true) {
            header("Location: index.php");  
            exit();
        }
    }

    // Protect Page
    function protect_page() {
        if(logged_in() === false) {
            header("Location: protected.php");
            exit();
        }
    }

    function output_errors($errors) {
        return "<ul><li>" . implode("</li><li>", $errors) . "</li></ul>";
    }

    function array_sanitize(&$item) {
        global $link;
        $item = strip_tags(mysqli_real_escape_string($link, $item));
    }

    function sanitize($data) {
        global $link;
        return htmlentities(strip_tags(mysqli_real_escape_string($link, $data)));    
    }

   function multiexplode ($delimiters, $string) {
        $ready = str_replace($delimiters, $delimiters[0], $string);
        $launch = explode($delimiters[0], $ready);
        return  $launch;
    }
?>