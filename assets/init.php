<?php
/*
    $_ENV["HOSTNAME"] = "DEVELOPING";
    $linkToALL = "/convo";  
    $root = $_SERVER["DOCUMENT_ROOT"] . "/";
    */

    session_start();
 
    require "database/connect.php";
    require "functions/users.php";
    require "functions/general.php";

    if(logged_in() === true) {
        $session_user_id = $_SESSION['azs_employee_id'];
        
        $user_data = user_data($session_user_id, 'azs_employee_id', "first_name", "last_name", "middle_name", "job_code", "hire_date", "main_phone", "ssn", "address", "city", "state", "zip_code", "email", "date_of_birth", "mobile_phone", "username", "password");
        
        
                
    }
?>