<?php 
    $title = "Day Off Request";
    require_once "includes/phpmailer/vendor/autoload.php";
    require("includes/phpmailer/libs/PHPMailer/class.phpmailer.php");
    include("assets/inc/header.inc.php");
    protect_page();

    $azs_employee_id = $user_data["azs_employee_id"];
    

    $errorDate = $errorReason = "";
    $date1 = $date2 = $date3 = $date4 = $date5 = "";
    $firstname = sanitize($user_data["first_name"]);
    $lastname = sanitize($user_data["last_name"]);
    if(isset($_POST["submit"])) {
        if(empty($_POST["date1"])) {
            $errorDate = "<span class='error'>Please select first date.</span>";   
        }
        else if($_POST["date1"] == $_POST["date2"] || $_POST["date1"] == $_POST["date3"] || $_POST["date1"] == $_POST["date4"] || $_POST["date1"] == $_POST["date5"]) {
            $errorDate = "<span class='error'>You cannot put two same dates.</span>"; 
        }
        if(empty($_POST["date2"])) {
            
        }
        else if($_POST["date2"] == $_POST["date3"] || $_POST["date2"] == $_POST["date4"] || $_POST["date2"] == $_POST["date5"]) {
            $errorDate = "<span class='error'>You cannot put two same dates.</span>";     
        }
        if(empty($_POST["date3"])) {
            
        }
        else if($_POST["date3"] == $_POST["date4"] || $_POST["date3"] == $_POST["date5"]) {
            $errorDate = "<span class='error'>You cannot put two same dates.</span>";     
        }
        if(empty($_POST["date4"])) {
            
        }
        else if($_POST["date4"] == $_POST["date5"]) {
            $errorDate = "<span class='error'>You cannot put two same dates.</span>";     
        }
        if(empty($_POST["date5"])) {
            
        }
        /*
        if(empty($_POST["date1"])) {
            $errorDate = "<span class='error'>Please select first date.</span>"; 
        }
        else if(empty($_POST["date2"]) || empty($_POST["date3"]) || empty($_POST["date4"]))         {
            
        }
        else if($_POST["date1"] == $_POST["date2"] || $_POST["date1"] == $_POST["date3"] || $_POST["date1"] == $_POST["date4"] || $_POST["date2"] == $_POST["date3"] || $_POST["date2"] == $_POST["date4"] || $_POST["date3"] == $_POST["date4"]){
            $errorDate = "<span class='error'>You cannot put two same dates.</span>"; 
        }
        */
        if(empty($_POST["request_reason"])) {
            $errorReason = "<span class='error'>Please enter your reason.</span>"; 
        }
        if($errorDate == "" && $errorReason == "") {
            $employee_id = $user_data['azs_employee_id'];
            $date1 = sanitize($_POST["date1"]);
            $date2 = sanitize($_POST["date2"]);
            $date3 = sanitize($_POST["date3"]);
            $date4 = sanitize($_POST["date4"]);
            $date5 = sanitize($_POST["date5"]);
            $reason = sanitize($_POST["request_reason"]);
            //$reason = str_replace("\\r\\n", "<br/>", $reason);
            
            $sql_date2 = $sql_date3 = $sql_date4 = $sql_date5 = "1969-01-01";

            // Convert from MM-DD-YYYY to YYYY-MM-DD to follow the MySQL Date Format
            $dateInput1 = multiexplode(array("-", "/"), $date1);
            $sql_date1 = $dateInput1[2] . "-" . $dateInput1[0] . "-" . $dateInput1[1];

            if(!empty($_POST["date2"])) {
                $dateInput2 = multiexplode(array("-", "/"), $date2);
                $sql_date2 = $dateInput2[2] . "-" . $dateInput2[0] . "-" . $dateInput2[1];
            }
            if(!empty($_POST["date3"])) {
                $dateInput3 = multiexplode(array("-", "/"), $date3);
                $sql_date3 = $dateInput3[2] . "-" . $dateInput3[0] . "-" . $dateInput3[1];
            }
            if(!empty($_POST["date4"])) {
                $dateInput4 = multiexplode(array("-", "/"), $date4);
                $sql_date4 = $dateInput4[2] . "-" . $dateInput4[0] . "-" . $dateInput4[1];
            }
            if(!empty($_POST["date5"])) {
                $dateInput5 = multiexplode(array("-", "/"), $date5);
                $sql_date5 = $dateInput5[2] . "-" . $dateInput5[0] . "-" . $dateInput5[1];
            }
           // echo "CALL insert_request('$first_name', '$last_name', '$sql_date1', '$sql_date2', '$sql_date3', '$sql_date4', '$reason')";
            
            mysqli_query($link, "CALL insert_request('$employee_id', '$firstname', '$lastname', '$sql_date1', '$sql_date2', '$sql_date3', '$sql_date4', '$sql_date5', '$reason')");
            $bodyMessage = $date1 . "<br/>" . $date2 . "<br/>" . $date3 . "<br/>" . $date4 . "<br/>" . $date5 . "<br/><br/><strong>Reason:</strong> " . str_replace("\\r\\n", "<br/>", $reason);
             $fullBody = "<p>" . $firstname . " requested day(s) off: <br/><br/>" . $bodyMessage . "</p>";
             $subjectHeader = "Day Request";
            
             requestEmail($user_data['email'], $firstname, $lastname, $fullBody, $subjectHeader);
            
             echo "<h3>The Day Off Request was sent successfully!</h3>";
             die(); 
        }
    }
    else if(isset($_GET["request_id"])) {
        $get_request_id = $_GET["request_id"];
        $query = "SELECT * FROM request_vw WHERE request_id = $get_request_id AND azs_employee_id = $azs_employee_id";
        $result = mysqli_query($link, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $date1 = $row["first_date"];
            $date2 = $row["second_date"];
            $date3 = $row["third_date"];
            $date4 = $row["fourth_date"];
            $date5 = $row["fifth_date"];
            $reason = $row["reason"];
            $status = $row["status"];
        }
        
        if(isset($_POST["Save"])) {
            if(empty($_POST["date1"])) {
                $errorDate = "<span class='error'>Please select first date.</span>";   
            }
            else if($_POST["date1"] == $_POST["date2"] || $_POST["date1"] == $_POST["date3"] || $_POST["date1"] == $_POST["date4"] || $_POST["date1"] == $_POST["date5"]) {
                $errorDate = "<span class='error'>You cannot put two same dates.</span>"; 
            }
            if(empty($_POST["date2"])) {

            }
            else if($_POST["date2"] == $_POST["date3"] || $_POST["date2"] == $_POST["date4"] || $_POST["date2"] == $_POST["date5"]) {
                $errorDate = "<span class='error'>You cannot put two same dates.</span>";     
            }
            if(empty($_POST["date3"])) {

            }
            else if($_POST["date3"] == $_POST["date4"] || $_POST["date3"] == $_POST["date5"]) {
                $errorDate = "<span class='error'>You cannot put two same dates.</span>";     
            }
            if(empty($_POST["date4"])) {

            }
            else if($_POST["date4"] == $_POST["date5"]) {
                $errorDate = "<span class='error'>You cannot put two same dates.</span>";     
            }
            if(empty($_POST["date5"])) {

            }
            if(empty($_POST["request_reason"])) {
                $errorReason = "<span class='error'>Please enter your reason.</span>"; 
            }
            if($errorDate == "" && $errorReason == "") {
                $employee_id = $user_data['azs_employee_id'];
                $date1 = sanitize($_POST["date1"]);
                $date2 = sanitize($_POST["date2"]);
                $date3 = sanitize($_POST["date3"]);
                $date4 = sanitize($_POST["date4"]);
                $date5 = sanitize($_POST["date5"]);
                $reason = sanitize($_POST["request_reason"]);

                $sql_date2 = $sql_date3 = $sql_date4 = $sql_date5 = "1969-01-01";

                // Convert from MM-DD-YYYY to YYYY-MM-DD to follow the MySQL Date Format
                $dateInput1 = multiexplode(array("-", "/"), $date1);
                $sql_date1 = $dateInput1[2] . "-" . $dateInput1[0] . "-" . $dateInput1[1];

                if(!empty($_POST["date2"])) {
                    $dateInput2 = multiexplode(array("-", "/"), $date2);
                    $sql_date2 = $dateInput2[2] . "-" . $dateInput2[0] . "-" . $dateInput2[1];
                }
                if(!empty($_POST["date3"])) {
                    $dateInput3 = multiexplode(array("-", "/"), $date3);
                    $sql_date3 = $dateInput3[2] . "-" . $dateInput3[0] . "-" . $dateInput3[1];
                }
                if(!empty($_POST["date4"])) {
                    $dateInput4 = multiexplode(array("-", "/"), $date4);
                    $sql_date4 = $dateInput4[2] . "-" . $dateInput4[0] . "-" . $dateInput4[1];
                }
                if(!empty($_POST["date5"])) {
                    $dateInput5 = multiexplode(array("-", "/"), $date5);
                    $sql_date5 = $dateInput5[2] . "-" . $dateInput5[0] . "-" . $dateInput5[1];
                }
                
                 
                
                if($status == "Reviewed"){
                    mysqli_query($link, "CALL delete_approved_request('$get_request_id')");
                    //echo "DELETE FROM approved WHERE request_id='$get_request_id'";
                    
                    $bodyMessage = $date1 . "<br/>" . $date2 . "<br/>" . $date3 . "<br/>" . $date4 . "<br/>" . $date5 . "<br/><br/><strong>Reason:</strong> " . str_replace("\\r\\n", "<br/>", $reason);
                    
                    $fullBody = "<p>" . $firstname . " made the changes for request day(s) off: <br/><br/>" . $bodyMessage . "</p>";
                    $subjectHeader = "Day Request Changed";
                    requestEmail($user_data['email'], $firstname, $lastname, $fullBody, $subjectHeader);
                }
                mysqli_query($link, "CALL update_day_request('$get_request_id', '$sql_date1', '$sql_date2', '$sql_date3', '$sql_date4', '$sql_date5', '$reason')");
                
                echo "UPDATE SUCCESSFULLY!";
                die();
                
            }
        }
        else if(isset($_POST["Remove"])) {
            
            
            
            
            if($status == "Reviewed"){
                mysqli_query($link, "CALL delete_approved_request('$get_request_id')");
               $bodyMessage = $firstname . " " . $lastname . " deleted Request No." . $get_request_id;
             $subjectHeader = "Day Request Deleted";
                    requestEmail($user_data['email'], $firstname, $lastname, $bodyMessage, $subjectHeader);    
            }
            mysqli_query($link, "CALL delete_day_request('$get_request_id')");
            
            echo "DELETE SUCCESSFULLY!";
            die();
        }
    }
?>
                    <h1>Day Off Request</h1>

                    <p>The Day Off Request Form is to fill out the information for specific day you want to take a break.  Once you submit the form, you will receive an e-mail from the one of the manager that determines if they accept or reject your request.</p>

                    <form class="form-horizontal day_request" method="POST">
                        <div class="form-group form-group-default">
                            <div class="row">
                                <!--<div class="col-md-3">
                                    <span class="form_span">First Name</span>
                                    <input class="form-control" type="text" name="first_name" placeholder="First Name" value=<?php echo $user_data["first_name"]; ?> readonly><?php echo $errorFirst; ?>
                                </div>
                                <div class="col-md-3">
                                    <span class="form_span">Last Name</span>
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" value=<?php echo $user_data["last_name"]; ?> readonly><?php echo $errorLast; ?>
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="form_span">Date</span>
                                    <em class="note">First date is required and rest of the dates are optional.</em> <?php echo $errorDate; ?>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control datepicker" type="text" name="date1" placeholder="First Date" value=<?php if(isset($_POST["submit"]) || isset($_POST["Save"])){echo $_POST['date1'];}else if(isset($get_request_id)) { if($date1 == "1969-01-01") { } else { echo date('m/d/Y', strtotime($date1)); }} ?>>
                                    <input class="form-control datepicker" type="text" name="date2" placeholder="Second Date" value=<?php if(isset($_POST["submit"]) || isset($_POST["Save"])){echo $_POST['date2'];}else if(isset($get_request_id)) { if($date2 == "1969-01-01") { } else { echo date('m/d/Y', strtotime($date2)); }} ?>>
                                    <input class="form-control datepicker" type="text" name="date3" placeholder="Third Date" value=<?php if(isset($_POST["submit"]) || isset($_POST["Save"])){echo $_POST['date3'];}else if(isset($get_request_id)) { if($date3 == "1969-01-01") { } else { echo date('m/d/Y', strtotime($date3)); }} ?>>
                                    <input class="form-control datepicker" type="text" name="date4" placeholder="Fourth Date" value=<?php if(isset($_POST["submit"]) || isset($_POST["Save"])){echo $_POST['date4'];}else if(isset($get_request_id)) { if($date4 == "1969-01-01") { } else { echo date('m/d/Y', strtotime($date4)); }} ?>>
                                    <input class="form-control datepicker" type="text" name="date5" placeholder="Fifth Date" value=<?php if(isset($_POST["submit"]) || isset($_POST["Save"])){echo $_POST['date5'];}else if(isset($get_request_id)) { if($date5 == "1969-01-01") { } else { echo date('m/d/Y', strtotime($date5)); }} ?>>
                                </div> 
                            </div>
                            <span class="form_span">Reason</span>
                            <?php echo $errorReason; ?>
                                    <textarea class="form-control" name="request_reason" rows="4"><?php if(isset($_POST["request_reason"]) && isset($_POST["submit"])){echo $_POST['request_reason'];}else if(isset($get_request_id)) { echo $reason; } ?></textarea>
<?php
    if(isset($get_request_id)) {
      echo "<input type='submit' class='btn btn-success' name='Save' value='Save'/>";
        echo "<input type='submit' class='btn btn-danger' name='Remove' value='Remove'/>";
    }
   else {
      echo "<input type='submit' class='btn btn-default' name='submit' value='Submit'/>";

   }
?>
                        </div>
                    </form>
<?php
echo "<h1>Request History</h1>";
    echo "<div class='table-responsive'><table class='table table-bordered table-hover request_list_table' id='tab_logic'>";
    echo "<thead><tr>";
    echo "<th>Request No.</th><th>Date(s)</th><th>Reason</th><th>Status</th>";
    echo "</thead></tr><tbody>";   

    $query = "SELECT * FROM request_vw WHERE azs_employee_id = $azs_employee_id";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_affected_rows($link);
    if ($result && $num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$request_id = $row["request_id"];
            if($row["status"] !== "Rejected") {
                echo "<tr><td width='10%;'><a href='day_request.php?request_id=" . $row["request_id"] . "'>" . $row["request_id"] . "</a></td>";
            }
            else {
               echo "<tr><td width='10%;'>" . $row["request_id"] . "</td>"; 
            }
            
            echo "<td>";  
            if($row["first_date"] == "1969-01-01"){
                
            }
            else{
                echo date('l, F d, Y', strtotime($row["first_date"])) . "<br/>"; 
            }
            if($row["second_date"] == "1969-01-01") {
                
            }
            else {
                echo date('l, F d, Y', strtotime($row["second_date"])) . "<br/>"; 
            }
            if($row["third_date"] == "1969-01-01") {
                  
            }
            else {
                echo date('l, F d, Y', strtotime($row["third_date"])) . "<br/>";   
            }
            if($row["fourth_date"] == "1969-01-01") {
                
            }
            else {
                echo date('l, F d, Y', strtotime($row["fourth_date"])) . "<br/>";   
            } 
            if($row["fifth_date"] == "1969-01-01") {
                
            }
            else {
                echo date('l, F d, Y', strtotime($row["fifth_date"]));   
            }
            echo "</td><td width='40%;'>" . $row["reason"] . "</td><td>" . $row["status"] . "</td>";
        }
    }

    echo "</tr></tbody></table></div>";


    include("assets/inc/footer.inc.php"); 
?>