<?php 
    $title = "Day Off Request";
    include("assets/inc/header.inc.php");
    protect_page();

    $errorFirst = $errorLast = $errorDate = $errorReason = "";
    if(isset($_POST["submit"])) {
        if(empty($_POST["first_name"])) {
            $errorFirst = "<span class='error'>Please enter your first name.</span>"; 
        }
        if(empty($_POST["last_name"])) {
            $errorLast = "<span class='error'>Please enter your last name.</span>"; 
        }
        if(empty($_POST["date1"])) {
            $errorDate = "<span class='error'>Please select date.</span>"; 
        }
        if(empty($_POST["request_reason"])) {
            $errorReason = "<span class='error'>Please enter your reason.</span>"; 
        }
        if($errorFirst == "" && $errorLast == "" && $errorDate == "" && $errorReason == "") {
            $first_name = sanitize($_POST["first_name"]);
            $last_name = sanitize($_POST["last_name"]);
            $date1 = sanitize($_POST["date1"]);
            $date2 = sanitize($_POST["date2"]);
            $date3 = sanitize($_POST["date3"]);
            $date4 = sanitize($_POST["date4"]);
            $reason = sanitize($_POST["request_reason"]);
            
            $sql_date2 = $sql_date3 = $sql_date4 = "1969-01-01";

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
           // echo "CALL insert_request('$first_name', '$last_name', '$sql_date1', '$sql_date2', '$sql_date3', '$sql_date4', '$reason')";
            
            mysqli_query($link, "CALL insert_request('$first_name', '$last_name', '$sql_date1', '$sql_date2', '$sql_date3', '$sql_date4', '$reason')");
            
             echo "<h3>The Day Off Request was sent successfully!</h3>";
             die(); 
        }
    }
?>
                    <h1>Day Off Request</h1>

                    <p>The Day Off Request Form is to fill out the information for specific day you want to take a break.  Once you submit the form, you will receive an e-mail from the one of the manager that determines if they accept or reject your request.</p>

                    <form class="form-horizontal day_request" method="POST">
                        <div class="form-group form-group-default">
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="form_span">First Name</span>
                                    <input class="form-control" type="text" name="first_name" placeholder="First Name" value=<?php if(isset($_POST["submit"])){echo $_POST['first_name'];} ?>><?php echo $errorFirst; ?>
                                </div>
                                <div class="col-md-3">
                                    <span class="form_span">Last Name</span>
                                    <input class="form-control" type="text" name="last_name" placeholder="Last Name" value=<?php if(isset($_POST["submit"])){echo $_POST['last_name'];} ?>><?php echo $errorLast; ?>
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <span class="form_span">Date</span>
                                    <em class="note">First date is required and rest of the dates are optional.</em> <?php echo $errorDate; ?>
                                </div>
                                <div class="col-md-2">
                                    <input class="form-control datepicker" type="text" name="date1" placeholder="First Date" value=<?php if(isset($_POST["submit"])){echo $_POST['date1'];} ?>>
                                    <input class="form-control datepicker" type="text" name="date2" placeholder="Second Date">
                                    <input class="form-control datepicker" type="text" name="date3" placeholder="Third Date">
                                    <input class="form-control datepicker" type="text" name="date4" placeholder="Fourth Date">
                                </div> 
                            </div>
                            <span class="form_span">Reason</span>
                            <?php echo $errorReason; ?>
                                    <textarea class="form-control" name="request_reason" rows="4"><?php if(isset($_POST["request_reason"]) && isset($_POST["submit"])){echo $_POST['request_reason'];} ?></textarea>
                            <br/>
                            <input type="submit" class="btn btn-default" name="submit" value="Submit"/>
                        </div>
                    </form>

<?php
    include("assets/inc/footer.inc.php"); 
?>