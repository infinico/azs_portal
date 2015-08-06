<?php
    /*
    * LOGIN FUNCTIONS
    */
    function logged_in() {
        return(isset($_SESSION['azs_employee_id'])) ? true : false;   
    }

    function user_id_from_username($username) {
        global $link;
        $username = sanitize($username);
        $query = mysqli_query($link, "SELECT azs_employee_id FROM employee WHERE username = '$username'");
        //return mysql_result($query, 0, "azs_employee_id");
        while($row = mysqli_fetch_assoc($query)){
            if(mysqli_num_rows($query) > 0 ) {
                //echo "Login Successful";
                return $row["azs_employee_id"];   
            }
            else {
                return false;   
            }
        }
    }

     function login($username, $password) {
         global $link;
        $user_id = user_id_from_username($username);

        $username = sanitize($username);
        $password = sha1($password);

        $query = mysqli_query($link, "SELECT azs_employee_id FROM employee WHERE username = '$username' AND password = '$password'");
        if(mysqli_num_rows($query) > 0 ) {
            echo "Login Successful";
            return $user_id;   
        }
        else {
            return false;   
        }
    }

    /*
    * EMPLOYEE INFORMATION DATA
    */
    function user_data($user_id) {
        global $link;
        $data = array();
        $user_id = $user_id;
        
        $func_num_args = func_num_args();
        $func_get_args = func_get_args();
        
        if($func_num_args > 1) {
            unset($func_get_args[0]);
            
            $fields = "" . implode(", ", $func_get_args) . "";
            $query = mysqli_query($link, "SELECT $fields FROM employee WHERE azs_employee_id = '$user_id'");
            //$result = mysql_result($link, $query);
            $data = mysqli_fetch_assoc($query);
            
            return $data;
        }
    }

    /*
    * EXIST FUNCTIONS
    */
    function user_exists($username) {
        global $link;
        $username = sanitize($username);
        $query = mysqli_query($link, "SELECT * FROM employee WHERE username = '$username'");
        if(mysqli_num_rows($query) > 0 ) {
            return true;   
        }
        else {
            return false;   
        }
    }

    function register_verify_exists($ssn, $dob) {
        global $link;
        $ssn = sanitize($ssn);
        $dob = sanitize($dob);
        $query = mysqli_query($link, "SELECT * FROM employee WHERE ssn = '$ssn' AND date_of_birth = '$dob'");
        if(mysqli_num_rows($query) > 0 ) {
            return true;   
        }
        else {
            return false;   
        }
    }

    function email_exists($email) {
        global $link;
        $emil= sanitize($email);
        $query = mysqli_query($link, "SELECT azs_employee_id FROM employee WHERE email = '$email'");
        if(mysqli_num_rows($query) > 0 ) {
            return true;   
        }
        else {
            return false;   
        }
    }

 // Register the username
    function register_user($register_data, $ssn, $dob) { 
        global $link;
        array_walk($register_data, "array_sanitize");
        $password = sha1($register_data["password"]);
        $username = $register_data["username"];
        
        $fields = "" . implode(", ", array_keys($register_data)) . "";
        $data = "\"" . implode("\" , \"", $register_data) . "\"";
        
        mysqli_query($link, "UPDATE employee SET username = '$username', password = '$password' WHERE ssn = '$ssn' AND date_of_birth = '$dob'");
    }

    // The users are active when they register the usernames
    function user_active($username) {
        global $link;
        $username = sanitize($username);
        $query = mysqli_query($link, "SELECT azs_employee_id FROM employee WHERE username = '$username'");
        if(mysqli_num_rows($query) > 0 ) {
            return true;   
        }
        else {
            return false;   
        }
    }

    /*
    * CHANGING PASSWORD FUNCTION
    */
    function change_password($user_id, $password) {
        global $link;
        $user_id = $user_id;
        $password = sha1($password);
        mysqli_query($link, "UPDATE employee SET password = '$password', password_recover = 0 WHERE azs_employee_id = '$user_id'");    
    }

    /*
    * RECOVER FUNCTIONS
    */
    function recover($mode, $email) {
            $mode = sanitize($mode);
            $email = sanitize($email);

            $user_data = user_data(user_id_from_email($email), "azs_employee_id", "firstname", "username");

            if($mode == "username") {
                // Recover username
               // email($email, "Your username", "Hello " . $user_data["firstname"] . "\n\nYour username is: " . $user_data["username"] . "\n\n -CONVO Portal");
            }
            else if($mode == "password") {
                // Recover password
                $generated_password = substr(sh1(rand(999, 999999)), 0, 8);
                //die($generated_password);
                change_password($user_data["azs_employee_id"], $generated_password);

                update_user($user_data["azs_employee_id"], array("password_recover" => "1"));

                //email($email, "Your password recovery", "Hello " . $user_data["firstname"] . "\n\nYour new password is: " . $generated_password . "\n\n -CONVO Portal");
            }
        }

    /*
    * UPDATE FUNCTIONS
    */
    // Whenever the employees update the information
    function update_user($user_id, $update_data) { 
        global $link;
        $update = array();
        array_walk($update_data, "array_sanitize");

        foreach($update_data as $field => $data) {
            $update[] = "$field = \"$data\"";
        }
        mysqli_query($link, "UPDATE employee SET " . implode(", ", $update) . " WHERE azs_employee_id = '$user_id'") or die(mysqli_error($link));
    }



function requestEmail($email, $firstname, $lastname, $bodyMessage, $subjectHeader){
    global $COOP1Email, $COOP1Name, $COOP2Email, $COOP2Name, $SupervisorCOOPEmail, $SupervisorName;
    $receiver = new PHPMailer;
        
    $receiver->SMTPAuth = true;

    $receiver->Host = 'stmp.gmail.com';
    $receiver->Username = 'convoportal@gmail.com';
    $receiver->Password = 'ConvoPortal#1!';
    $receiver->STMPSecure = 'ssl';
    $receiver->Port = 465;

    $receiver->From = $email;
    $receiver->FromName = $firstname . " " . $lastname;
    $receiver->AddAddress('pxy9548@rit.edu', 'Peter Yeung');
    $receiver->AddCC($COOP1Email, $COOP1Name);
    $receiver->AddCC($COOP2Email, $COOP2Name);
    $receiver->AddCC($SupervisorCOOPEmail, $SupervisorName);

    $message2 = "<p>Hello HR,</p>";
    $message2 .= $bodyMessage;
    $message2 .= "<p>" . $firstname . " " . $lastname . "</p>";

    if($_ENV["HOSTNAME"] = "TESTING"){
        $subject2 = 'AZS - ' . $subjectHeader . ' TESTING'; 
    }
    else if($_ENV["HOSTNAME"] = "DEVELOPING"){
        $subject2 = 'AZS - ' . $subjectHeader . ' DEVELOPING'; 
    }


    $receiver->Subject = $subject2;
    $receiver->Body = $message2;
    $receiver->AltBody = $bodyMessage;

    $receiver->send();

}



function has_access_manager($job_code) {
    global $link;
    $job_code = $job_code;    
    $query = mysqli_query($link, "SELECT job_code FROM position WHERE job_code = '$job_code' AND manager_privilege = '1'");
    if(mysqli_num_rows($query) > 0 ) {
        return true;   
    }
    else {
        return false;   
    }
}

function test_employee_id($employeeID){
    global $link;
    $query = mysqli_query($link, "SELECT * FROM employee WHERE employee_id = '$employeeID'");
    if(mysqli_num_rows($query) > 0 ) {
        return true;   
    }
    else {
        return false;   
    }
}



?>