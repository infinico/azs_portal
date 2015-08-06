<?php 
    $title = "Request Review";
    include("assets/inc/header.inc.php");
    
    protect_page();
    if(logged_in() == true){
        manager_protect();
    }

    $request_id = $_GET["request_id"];
    $query = mysqli_query($link, "SELECT * FROM request_vw WHERE request_id=$request_id");
    while($row = mysqli_fetch_assoc($query)) {
        $request_id = $row["request_id"];
        $first_name = $row["first_name"];
        $last_name = $row["last_name"];
        $date1 = $row["first_date"];
        $date2 = $row["second_date"];
        $date3 = $row["third_date"];
        $date4 = $row["fourth_date"];
        $date5 = $row["fifth_date"];
        $reason = $row["reason"];
    }

    if(isset($_POST['submit'])){
        
        $approved_date1 = $approved_date2 = $approved_date3 = $approved_date4 = $approved_date5 = "";
        //echo "Success";
        if(isset($_POST['date1'])){
            $approved_date1 = $_POST['date1'];
        }
        else{
            $approved_date1 = "1969-01-01";
        }
        if(isset($_POST['date2'])){
            $approved_date2 = $_POST['date2'];
        }
        else{
            $approved_date2 = "1969-01-01";
        }
        if(isset($_POST['date3'])){
            $approved_date3 = $_POST['date3'];
        }
        else{
            $approved_date3 = "1969-01-01";
        }
        if(isset($_POST['date4'])){
            $approved_date4 = $_POST['date4'];
        }
        else{
            $approved_date4 = "1969-01-01";
        }
        if(isset($_POST['date5'])){
            $approved_date5 = $_POST['date5'];
        }
        else{
            $approved_date5 = "1969-01-01";
        }
        
        mysqli_query($link, "CALL insert_approved_request('$request_id', '$approved_date1', '$approved_date2', '$approved_date3', '$approved_date4', '$approved_date5', '$reason')");
        mysqli_query($link, "CALL update_request('$request_id', 'Reviewed')");
        
        //echo "INSERT INTO approved(request_id, date1, date2, date3, date4) VALUES('$request_id', '$approved_date1', '$approved_date2', '$approved_date3', '$approved_date4')";
        //echo "UPDATE request SET status = 'Reviewed' WHERE request_id = '$request_id'";
        //echo "CALL insert_approved_request('$request_id', '$approved_date1', '$approved_date2', '$approved_date3', '$approved_date4', '$reason')";
        
        echo "SUCCESSFULLY!";
        
        die();
        
    }
?>
                    <h1>Request Review</h1>

                    <form class="request_review" method="post">
                        <div class="form-group form-group-default">
                             <div class="row">
                                <div class="col-xs-2">
                            <span class="form_span">First Name</span>
                       <input type="text" class="form-control" name="first_name" value="<?php echo $first_name;?>" readonly>
                        </div>
                                 <div class="col-xs-2">
                                    <span class="form_span">Last Name</span>
                                    <input class="form-control" type="text" name="last_name" value="<?php echo $last_name;?>" readonly>
                                </div> 
                            </div><br/>
                            <span class="form_span">Dates</span><br/>
                            <input type="checkbox" name="date1" value='<?php echo $date1;?>'> <?php echo date('l, F d, Y', strtotime($date1));?><br/>
                            
<?php
    if($date2 == "1969-01-01") {

    }
    else {
        echo "<input type='checkbox' name='date2' value='". $date2 . "'> " . date('l, F d, Y', strtotime($date2)) . "<br/>";
    }
    if($date3 == "1969-01-01") {

    }
    else {
        echo "<input type='checkbox' name='date3' value='" . $date3 . "'> " . date('l, F d, Y', strtotime($date3)) . "<br/>";
    }
    if($date4 == "1969-01-01") {

    }
    else {
        echo "<input type='checkbox' name='date4' value='" . $date4 . "'> " . date('l, F d, Y', strtotime($date4)) . "<br/>";
    }
    if($date5 == "1969-01-01") {

    }
    else {
        echo "<input type='checkbox' name='date5' value='" . $date5 . "'> " . date('l, F d, Y', strtotime($date5)) . "<br/>";
    }
?>
                            
                            <br/><span class="form_span">Reason</span>
                            <textarea class="form-control" name="request_reason" rows="3" readonly><?php echo $reason;?></textarea><br/>
                            <input type="submit" class="btn btn-success" name="submit" value="Submit"/>
                    </form>
                        
<?php
    include("assets/inc/footer.inc.php"); 
?>