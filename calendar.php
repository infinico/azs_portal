<?php 
    $page_title = "Event Calendar";
    //error_reporting(0);
    $title = "Event Calendar";
    //admin_protect();
    include("assets/inc/header.inc.php"); 
?>
            <script>
                function goLastMonth(month, year){
                    if(month == 1){
                        --year;
                        month = 13;
                    }
                    --month;
                    var monthstring = ""+month+"";
                    var monthlength = monthstring.length;
                    if(monthlength <= 1){
                        monthstring = "0"+monthstring;   
                    }
                    document.location.href = "<?php $_SERVER["PHP_SELF"];?>?month="+monthstring+"&year="+year;
                }

                function goNextMonth(month, year){
                   if(month == 12){
                        ++year;
                       month = 0;
                   }
                    ++month;
                    var monthstring = ""+month+"";
                    var monthlength = monthstring.length;
                    if(monthlength <= 1){
                        monthstring = "0"+monthstring;   
                    }
                    document.location.href = "<?php $_SERVER["PHP_SELF"];?>?month="+monthstring+"&year="+year;
                }

                function hoverThis(){
                    $(".event_info").css("cursor", "pointer");
                }    
            </script>

<?php
    if(isset($_GET['day'])){
        $day = $_GET['day'];   
    }
    else{
        $day = date("j");
    }
    if(isset($_GET['month'])){
        $month = $_GET['month'];  
        //echo $month;
    }
    else{
        $month = date("n");
    }
    if(isset($_GET['year'])){
        $year = $_GET['year'];   
    }
    else{
        $year = date("Y");
    }

    $currentTimeStamp = strtotime("$year-$month-$day");
    $monthName = date("F", $currentTimeStamp);
    //echo $monthName;
    $numDays = date("t", $currentTimeStamp);
    //echo $numDays;
    $counter = 0;
?>
            <table border="1" id='eventTable'>
                <tr class="eventRow">
                    <td class="eventData"><input type="button" value='<' name='previousbutton' onclick="goLastMonth(<?php echo $month . ", " . $year?>)"></td>
                    <td colspan="5" id="monthYear"><?php echo $monthName . " " . $year;  ?></td>
                    <td class="eventData"><input type="button" value='>' name='nextbutton' onclick="goNextMonth(<?php echo $month . ", " . $year?>)"></td>
                </tr>
                <tr class="eventRow">
                    <td>Sunday</td>
                    <td>Monday</td>
                    <td>Tuesday</td>
                    <td>Wednesday</td>
                    <td>Thursday</td>
                    <td>Friday</td>
                    <td>Saturday</td>
                </tr>
<?php
    echo "<tr>";

    for($i = 1; $i < $numDays+1; $i++, $counter++){
        $timeStamp = strtotime("$year-$month-$i");
        $firstDay = '';
        //echo $month;
        if($i == 1){
            $firstDay = date("w", $timeStamp);

            for($j = 0; $j < $firstDay; $j++, $counter++){
                echo "<td>&nbsp;</td>";   
            }
        }
        if($counter % 7 == 0 && $counter != 0){
            echo "</tr><tr>";
        }
        $monthstring = $month;
        $monthlength = strlen($monthstring);
        $daystring = $i;
        $daylength = strlen($daystring);
        if($monthlength <= 1){
            $monthstring = "0" . $monthstring;   
        }
        if($daylength <= 1){
            $daystring = "0" . $daystring;   
        }

        $todayDate = date("m/d/Y");
        $dateToCompare = $monthstring . '/' . $daystring . '/' . $year;
        $dateInDB = $year . '-' . $monthstring . '-' . $daystring;




       // $eventCount = "SELECT * FROM request_calendar WHERE start_date = '" . $dateInDB . "'";   
        //$numEvent = mysqli_num_rows(mysqli_query($link, $eventCount));

        $requestQuery = "SELECT 
`r`.`first_name` AS `first_name`,
`r`.`last_name` AS `last_name`,
`a`.`first_date` AS `first_date`,
`a`.`second_date` AS `second_date`,
`a`.`third_date` AS `third_date`,
`a`.`fourth_date` AS `fourth_date`,
`a`.`fifth_date` AS `fifth_date`
FROM
(`azs_testing`.`request_vw` `r`
JOIN `azs_testing`.`approved_vw` `a` ON ((`r`.`request_id` = `a`.`request_id`))) WHERE `r`.`status` = 'Reviewed'";
        $result = mysqli_query($link, $requestQuery);




        echo "<td";

        if($todayDate == $dateToCompare){
            echo " class='today'";   
        }
        else{
            echo " class='days'";   
        }
            echo ">" . $i;

        $count = 1;
        while($row = mysqli_fetch_assoc($result)){
            $first_date = date("Y-m-d", strtotime($row['first_date']));
            $second_date = date("Y-m-d", strtotime($row['second_date']));
            $third_date = date("Y-m-d", strtotime($row['third_date']));
            $fourth_date = date("Y-m-d", strtotime($row['fourth_date']));
            $fifth_date = date("Y-m-d", strtotime($row['fifth_date']));

            if($dateInDB == $first_date || $dateInDB == $second_date || $dateInDB == $third_date || $dateInDB == $fourth_date || $dateInDB == $fifth_date){
                echo "<br/>";

                echo "<span class='requestData'>" . $count . ". " .  $row["first_name"] . " " . $row["last_name"] . "</a></span>";

                $count++;

            }
        }

        echo "</td>";
    }

    echo "</tr>";

?>

                </table>
                        <script>
                            $(function() {
                                var moveLeft = 0;
                                var moveDown = 0;
                                $('a.popper').hover(function(e) {

                                    var target = '#' + ($(this).attr('data-popbox'));

                                    $(target).show();
                                    moveLeft = $(this).outerWidth();
                                    moveDown = ($(target).outerHeight() / 2);
                                }, function() {
                                    var target = '#' + ($(this).attr('data-popbox'));
                                    $(target).hide();
                                });

                                $('a.popper').mousemove(function(e) {
                                    var target = '#' + ($(this).attr('data-popbox'));

                                    leftD = e.pageX + parseInt(moveLeft);
                                    maxRight = leftD + $(target).outerWidth();
                                    windowLeft = $(window).width() - 40;
                                    windowRight = 0;
                                    maxLeft = e.pageX - (parseInt(moveLeft) + $(target).outerWidth() + 20);

                                    if(maxRight > windowLeft && maxLeft > windowRight)
                                    {
                                        leftD = maxLeft;
                                    }

                                    topD = e.pageY - parseInt(moveDown);
                                    maxBottom = parseInt(e.pageY + parseInt(moveDown) + 20);
                                    windowBottom = parseInt(parseInt($(document).scrollTop()) + parseInt($(window).height()));
                                    maxTop = topD;
                                    windowTop = parseInt($(document).scrollTop());
                                    if(maxBottom > windowBottom)
                                    {
                                        topD = windowBottom - $(target).outerHeight() - 20;
                                    } else if(maxTop < windowTop){
                                        topD = windowTop + 20;
                                    }

                                    $(target).css('top', topD).css('left', leftD);
                                });
                            });    
                        </script>
<?php
    include("assets/inc/footer.inc.php");
?>