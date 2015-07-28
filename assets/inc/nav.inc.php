                <!-- Static navbar -->
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>            
                        </div>  <!-- End of the navbar-header -->
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="index.php">Home</a></li>
<?php
    if(logged_in()) {
?>
                                <li><a href="day_request.php">Day Off Request</a></li>
                                <li><a href="calendar.php">Calendar</a></li>
                                <li><a href="request_list.php">Request List</a></li>
<?php
    }
?>
                            </ul>   <!-- End of nav navbar-nav -->
                        </div>  <!-- End of the navbar -->
                    </div>  <!-- End of the container-fluid -->
                </nav>  <!-- End of the nav -->