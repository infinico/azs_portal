<?php 
    ob_start();
    $title = "Request List";
    include("assets/inc/header.inc.php");
    protect_page();

    echo "Today's Date is: " . date('l, F d, Y');
?>
                    <h1>Request List</h1>
<p>Whenever you accept the employee's r</p>
                    

<?php     
    echo "<div class='table-responsive'><table class='table table-bordered table-hover request_list_table' id='tab_logic'>";
    echo "<thead><tr>";
    echo "<th>Employee</th><th>Date(s)</th><th>Reason</th><th>Review/Reject</th>";
    echo "</thead></tr><tbody>";

    $query = "SELECT * FROM request_vw WHERE status = 'Pending'";

    $result = mysqli_query($link, $query);
    $num_rows = mysqli_affected_rows($link);
echo "<form method='POST'>";
    if ($result && $num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $request_id = $row["request_id"];

            echo "<tr><td>" . $row["last_name"] . ", " . $row["first_name"] . "</td><td>" .  date('l, F d, Y', strtotime($row["first_date"]));
            if($row["second_date"] == "1969-01-01") {
                   
            }
            else {
                echo " <br/>" .  date('l, F d, Y', strtotime($row["second_date"]));
            }
            if($row["third_date"] == "1969-01-01") {
                   
            }
            else {
                echo "<br/>" . date('l, F d, Y', strtotime($row["third_date"]));   
            }
            if($row["fourth_date"] == "1969-01-01") {
                   
            }
            else {
                 echo "<br/> " . date('l, F d, Y', strtotime($row["fourth_date"]));   
            }       
            echo "</td><td>" . $row["reason"] . "</td>";
          //  echo "<td width='20%'><input type='submit' id='request" . $request_id . "' class='btn btn-success' name='submit' value='Accept'> &nbsp;&nbsp;<input type='submit' id='decline" . $request_id . "' class='btn btn-danger' name='decline' value='Decline'></td>";
            echo "<td><a href='request_review.php?request_id=" . $request_id . "'><button type='button' id='review' class='btn btn-success' name='review" . $request_id . "'>Review</button></a> &nbsp; <input type='submit' class='btn btn-danger' name='reject" . $request_id . "' value='Reject'></td>";
            
            if(isset($_POST["review$request_id"])) {
               // echo "REVIEW " . $request_id;
            }

            if(isset($_POST["reject$request_id"])) {
                //echo "REJECT " . $request_id;
                $url = $_SERVER['PHP_SELF'];
                header("Refresh: 1; $url");
                mysqli_query($link, "UPDATE request SET status = 'Rejected' WHERE request_id = '$request_id'");
            } 
        }
    }
    echo "</tr></tbody></form></table></div>";
                             
    echo "<h2>Approved Requests</h2>";
    echo "<div class='table-responsive'><table class='table table-bordered table-hover request_list_table' id='tab_logic'>";
    echo "<thead><tr>";
    echo "<th>Request ID</th><th>Employee</th><th>Date(s)</th><th>Reason</th>";
    echo "</thead></tr><tbody>";

    
    $query = "SELECT 
        `a`.`request_id` AS `request_id`,
        `r`.`first_name` AS `first_name`,
        `r`.`last_name` AS `last_name`,
        `a`.`first_date` AS `first_date`,
        `a`.`second_date` AS `second_date`,
        `a`.`third_date` AS `third_date`,
        `a`.`fourth_date` AS `fourth_date`,
        `a`.`reason` AS `reason`
    FROM
        (`azs_testing`.`request_vw` `r`
        JOIN `azs_testing`.`approved` `a` ON ((`r`.`request_id` = `a`.`request_id`))) WHERE `r`.`status` = 'Reviewed'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_affected_rows($link);
    if ($result && $num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$request_id = $row["request_id"];

            echo "<tr><td width='10%;'>" . $row["request_id"] . "</td>";
            
            echo "<td width='20%;'>" . $row["last_name"] . ", " . $row["first_name"] .  "</td>";
            echo "<td>";  
            if($row["first_date"] == "1901-01-01"){
            }
            else{
                echo date('l, F d, Y', strtotime($row["first_date"])) . "<br/>";
            }
            if($row["second_date"] == "1901-01-01") {
                   
            }
            else {
                echo date('l, F d, Y', strtotime($row["second_date"])) . "<br/>";
            }
            if($row["third_date"] == "1901-01-01") {
                   
            }
            else {
                echo date('l, F d, Y', strtotime($row["third_date"])) . "<br/>";   
            }
            if($row["fourth_date"] == "1901-01-01") {
                   
            }
            else {
                 echo date('l, F d, Y', strtotime($row["fourth_date"]));   
            }       
            echo "</td><td width='40%;'>" . $row["reason"] . "</td>";
        }
    }



    



    
    echo "</tr></tbody></table></div>";



    echo "<h2>Rejected Requests</h2>";
    echo "<div class='table-responsive'><table class='table table-bordered table-hover request_list_table' id='tab_logic'>";
    echo "<thead><tr>";
    echo "<th>Request ID</th><th>Employee</th><th>Date(s)</th><th>Reason</th>";
    echo "</thead></tr><tbody>";

    
    $query = "SELECT * FROM request_vw WHERE status = 'Rejected'";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_affected_rows($link);
    if ($result && $num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            //$request_id = $row["request_id"];

            echo "<tr><td width='10%;'>" . $row["request_id"] . "</td>";
            
            echo "<td width='20%;'>" . $row["last_name"] . ", " . $row["first_name"] .  "</td>";
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
                 echo date('l, F d, Y', strtotime($row["fourth_date"]));   
            }       
            echo "</td><td width='40%;'>" . $row["reason"] . "</td>";
        }
    }



    



    
    echo "</tr></tbody></table></div>";


    include("assets/inc/footer.inc.php"); 
?>
