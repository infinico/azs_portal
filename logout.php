<?php
    session_start();
    session_destroy();

    //Redirect to home page after logout
    header("Location: index.php");
?>