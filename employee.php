<?php 
    $page_title = "Employees";
    $title = "Employees";
    include("assets/inc/header.inc.php");
?>

            <h1>Employees</h1>

<?php

    /*
    * See every employees
    */
    $query = "SELECT * FROM employee";
    $result = mysqli_query($link, $query);
    $num_rows = mysqli_affected_rows($link);
    echo "<div class='table-responsive'><table id='example' class='table table-striped table-hover dt-responsive' cellspacing='0'>";
    if ($result && $num_rows > 0) {
        echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Job Code</th><th>Hire Date</th><th>Phone Number</th><th>Email Address</th></tr></thead><tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["azs_employee_id"] . "</td><td>" . $row["first_name"] . "</td><td>" . $row["last_name"] .  "</td><td>" . $row["job_code"] . "</td><td>" . date('m/d/Y', strtotime($row["hire_date"])) . "</td><td>" . $row["main_phone"] . "</td><td>" . $row["email"] . "</td></tr>";
        }
    }
    echo "</tbody></table></div>";
    /*
    if(has_access($user_data["job_code"]) == true) {
        $query = "SELECT * FROM convo_employee_vw";
        $result = mysqli_query($link, $query);
    }
    else {
        $query = "SELECT * FROM convo_employee_vw WHERE supervisor_id = " . $user_data["employee_id"];
        $result = mysqli_query($link, $query);   
    }
    $num_rows = mysqli_affected_rows($link);
    echo "<table id='example' class='display' cellspacing='0' width='1010px'>";
        if ($result && $num_rows > 0) { 
           echo "<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Position</th><th>Supervisor</th><th>Hire Date</th><th>Review Date</th><th>Payroll Status</th><th>Hourly Rate</th><th>Status</th></tr></thead><tbody>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>";
                if(has_access($user_data["job_code"]) == true){
                    echo "<a href='$linkToALL/Admin/edit.php?employee_id=" . $row["employee_id"] . "'>" . $row["employee_id"] . "</a>";
                }
                else{
                    echo $row["employee_id"];
                }
            echo "</td><td>" . $row["firstname"] . "</td><td>" . $row["lastname"] .  "</td><td>" . $row["position"] . "</td><td>" . $row["supervisor"] . "</td><td>" . date("n/j/Y", strtotime($row["hireDate"])) . "</td>";
                if($row["reviewDate"] == "1-1-1900"){
                    echo "<td></td>";
                }
                else{
                   echo "<td>" . $row["reviewDate"] . "</td>";
                }
                
                echo "<td>" .  $row["payroll_status"]. "</td>";
                    if($row["hourly_rate"] == "0.00"){
                        echo "<td></td>";   
                    }
                else{
                    echo "<td>" . $row["hourly_rate"] . "</td>";
                }
                echo "<td>" . $row["employment_status"] . "</td></tr>";  
            }
        }        
    echo "</tbody></table>";
*/
    include("assets/inc/footer.inc.php");
?>