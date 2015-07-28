<?php 
    $title = "Change Password";
    include("assets/inc/header.inc.php");
    protect_page();
    $errors = "";

    if(empty($_POST) === false) {
        $required_fields = array("current_password", "password", "password_again");
        
        foreach($_POST as $key => $value) {
            if(empty ($value) && in_array($key, $required_fields) === true) {
                
            }
        } 
        
        if(sha1($_POST["current_password"]) === $user_data["password"]) {
            if(trim($_POST["password"]) !== trim($_POST["password_again"])) {
                $errors = "<span class='error'>Your new passwords do not match.</span>";
            } else if(strlen($_POST["password"]) < 6) {
                $errors = "<span class='error'>Your password must be at least 6 characters.</span>";  
            } 
        }
        else {
            $errors = "<span class='error'>Your current password is incorrect.</span>";
         }
    }

    $displayNone = "";

    if(isset($_GET["success"]) === true && empty($_GET["successs"]) === true) {
        echo "Your password has changed!"; 
    }
    else {
        if(isset($_GET["force"]) === true && empty($_GET["force"]) === true) {
        ?>
           <br/><h3 class="force_password" style='color:red;'>You must change your password now that you've requested.</h3>
        <?php
        }
        if(empty($_POST) === false && empty($errors) === true) {
            change_password($session_user_id, $_POST["password"]);
            $displayNone = "style='display:none'";
            
            echo "<h1>Your password has been changed successfully!</h1>";
?>
            <script>$(".force_password").hide()</script>
<?php
			die(); 
        }
        else if(empty($errors) === false) {
         //   echo output_errors($errors);

        }
    ?>

            <h1 <?php echo $displayNone; ?>>Change Password</h1>
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Current Password: </span> 
                            </div>
                            <div class="col-md-2">
                                <input type="password" class="form-control" name="current_password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">New Password: </span> 
                            </div>
                            <div class="col-md-2">
                                <input type="password" class="form-control" name="password"><em class="note">The password must be between 6 and 30 characters.</em>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="form_span">Confirm Password:</span> 
                            </div>
                            <div class="col-md-2">
                                 <input type="password" class="form-control" name="password_again">
                            </div>
                        </div><input type="submit" class="btn btn-success" name="submit" value="Change Password"><br/><br/>

            </form>
<?php 
        echo $errors;
    }
    include("assets/inc/footer.inc.php");
?>