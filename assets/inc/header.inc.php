<!--
Infini Consulting
Fedex Portal v1.5
Copyright 2015
-->

<?php
    ob_start();
    include("assets/init.php");

?>

<!DOCTYPE HTML>
<html lang="en">
    <head>  <!-- Head Starts -->
        <title>AZS | <?php echo $title; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex">
        
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <!-- Credits by jonthornton for Datepicker design and Timepicker-->
        <link rel="stylesheet" type="text/css" href="assets/css/jquery.timepicker.css" /> 
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css" />
    
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        
         <!-- Credits by jonthornton for Datepicker design and Timepicker-->
        <script type="text/javascript" src="assets/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.timepicker.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="assets/js/script.js"></script>
    </head> <!-- Head ends -->
    <body>    <!-- Body -->
        <div class="container"> <!-- div of the container --> 
            <div class="infini-logo">
                <a href="https://www.theinfini.com" target="_blank"><img class ="img-responsive" src="assets/images/infini.svg" alt="Infini" width="250"/></a>
            </div>         
<?php
    if(logged_in() === true) {
        include("loggedin.php");
    }
    else {
?>
            <form action="login.php" method="POST" class="login_form form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <input type="submit" name="login" class="btn btn-success" value="Login"> <a href="register.php"><button type="button" name="register" class="btn btn-default">Sign Up</button></a>
            </form> 
            <p class="forget_username_password">Forget your <a href="recover.php?mode=username">username</a> or <a href="recover.php?mode=password">password</a>?</p>
<?php
}

include("assets/inc/nav.inc.php");
?>
        <div id="wrapper">  <!-- Wrapper starts -->
            <div id="content">  <!-- Content starts -->
                <div class="fedex-logo">
                <a href="#"><img class ="img-responsive" src="assets/images/fedex.png" alt="Fedex" width="250"/></a>
            </div>
