<?php
    /* Environment Variables */
    $_ENV["HOSTNAME"] = "TESTING";
    $linkToALL = "https://test.theinfini.com/azs";  
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);

    /* 
        INCOMING CO-OP STUDENT INFORMATION:
        Please change the email address and name for testing.
        The variables are used for email functions (PHPMailer)
        If you have any questions, you can contact Chris at chris@theinfini.com 
    */
    $COOP1Email = 'jja4740@rit.edu';
    $COOP1Name = 'Joshua Aziz';
    $COOP2Email = 'pxy9548@rit.edu';
    $COOP2Name = 'Peter Yeung';
    $SupervisorCOOPEmail = 'chris@theinfini.com';
    $SupervisorName = 'Chris Campbell';


    session_start();
 
    require "database/connect.php";
    require "functions/users.php";
    require "functions/general.php";

    if(logged_in() === true) {
        $session_user_id = $_SESSION['azs_employee_id'];
        
        $user_data = user_data($session_user_id, 'azs_employee_id', "first_name", "last_name", "middle_name", "job_code", "hire_date", "main_phone", "ssn", "address", "city", "state", "zip_code", "email", "date_of_birth", "mobile_phone", "username", "password");
        
        
                
    }
?>