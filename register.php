<?php 
    $title = "Registration";
    include("assets/inc/header.inc.php");

    $errorId = "";

    if(isset($_POST["submit"])) {
        if(!empty($_POST["ssn_digits"]) && !empty($_POST["dob"])){
            $ssn = sanitize($_POST["ssn_digits"]);
            $dob = sanitize($_POST["dob"]);

            $dobInput = multiexplode(array("-", "/"), $dob);
            $date_of_birth = $dobInput[2] . "-" . $dobInput[0] . "-" . $dobInput[1];
            //echo $ssn;
            //echo $date_of_birth;
        }
        
        if(empty($_POST["ssn_digits"]) || empty($_POST["dob"])) {
            $errorId = "<span class='error'>Please enter your SSN and Date of Birth</span>";
        }
        else if(register_verify_exists($ssn, $date_of_birth) == false){
            $errorId = "<span class='error'>Wrong SSN or date of birth.  Please try again.</span>";
        }
        else if(empty($_POST["username"])){
            $errorId = "<span class='error'>Please enter username</span>";
        }
        else if(user_exists($_POST["username"]) === true) {
            $errorId = "<span class='error'>Sorry, the username \"" . $_POST["username"] . "\" is already taken.</span>";   
        }
        else if(preg_match("/\\s/", $_POST["username"]) == true) {
           // $regular_expression = preg_match("/\\s/", $_POST["username"]);
           // var_dump($regular_expression);
            $errorId = "<span class='error'>Your username must not contain any spaces.</span>";   
        }

        else if(strlen($_POST["password"]) < 6) {
            $errorId = "<span class='error'>Your password must be at least 6 characters</span>";
        }

        else if($_POST["password"] !== $_POST["password_again"]) {
             $errorId = "<span class='error'>Your passwords do not match</span>";   
        }
        
         if(empty($_POST) === false && empty($errorId) === true) {
           // register user
            $register_data = array(
                "username"      => $_POST["username"],
                "password"      => $_POST["password"],
            );
            
            $ssn = $_POST["ssn_digits"];
            $dob = $_POST["dob"];

            register_user($register_data, $ssn, $date_of_birth);
            // Redirect
            //header("Location: verify.php?success");
            echo "<h2>You have been registered successfully! Please login using the form at upper-right corner of the screen.</h2>";
            // Exit
            exit();
        }
    }
?>

                    <h1>Employee Registration</h1>
                    <p>Please create your own username and password.</p>

                    <form method="POST" action="register.php">
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Enter your last four SSN digits: </span> 
                            </div>
                            <div class="col-md-2">
                                <input type="password" class="form-control" name="ssn_digits" size='5' maxlength="4">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Enter your Date of Birth: </span> 
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="dob" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Username:</span> 
                            </div>
                            <div class="col-md-2">
                                 <input type="text" class="form-control" name="username">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Password:</span> 
                            </div>
                            <div class="col-md-2">
                                 <input type="password" class="form-control" name="password"><em class="note">The password must be between 6 and 30 characters.</em>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Repeat Password:</span> 
                            </div>
                            <div class="col-md-2">
                                 <input type="password" class="form-control" name="password_again">
                            </div>
                        </div>
                    <?php echo $errorId; ?>
                    <br/><input type="submit" class="btn btn-success" name="submit" value="Register"><br/><br/>

            </form>
<?php
    include("assets/inc/footer.inc.php"); 
?>
