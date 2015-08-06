<?php 
    $page_title = "Select Employee";
    ob_start();
    $title = "AZS Portal";
    include("assets/inc/header.inc.php");

    global $link;
    $resultemployee = mysqli_query($link, "SELECT * FROM employee_vw ORDER BY last_name ASC");


    if(isset($_POST["submit"])){
        
        echo "Submit";
        echo $_POST["employeeName"];
        if(empty($_POST["employeeName"])){
            echo "Please select an employee";   
        }
        else{
            echo "EMPLOYEE NAME";
            $_SESSION['azs_employee_id'] = $_POST["employeeName"];
            $session_user_id = $_SESSION['azs_employee_id'];
            test_employee_id($session_user_id);
           
            header("Location: index.php");
            exit();
        }
    }
?>
<h2>Impersonate Employee</h2>

    <form id="impersonateEmployee" method="POST" class="form-inline">
        <div class="form-group">
            <span class="form_span">Employee: </span>
        </div>
        <div class="form-group">
            <?php
                echo "<select id='employeeName' class='form-control' name='employeeName'><option value=''>Select an employee</option>";
                while($row = mysqli_fetch_assoc($resultemployee)) {
                    echo "<option value = '" . $row['azs_employee_id'] . "'";

                    echo ">" . $row['last_name'] . ", " . $row["first_name"] . "</option>";   
                }
                echo "</select>";?>
                    
                  <input type="submit" name="submit" class="btn btn-success" value="Next"/>
        </div>
    </form> 
<?php
    include("assets/inc/footer.inc.php"); 
?>