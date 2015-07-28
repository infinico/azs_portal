<?php
    $page_title = "Recover";
    $title = "Recover";
	include("assets/inc/header.inc.php");
    logged_in_redirect();

    if(isset($_GET["success"]) !== true) {
        if($_GET["mode"] == "password") {
            echo "<h1>Reset your Password</h1>"; 
            echo "<p>Please enter your email address to reset your password.</p>";
        }
        else if($_GET["mode"] == "username") {
            echo "<h1>Recover your Username</h1>"; 
            echo "<p>Please enter your email address to recover your username.</p>";
        }
    }
	if(isset($_GET["success"]) === true && empty($_GET["success"]) === true) {
?>
	<h2>You will recieve an email you requested shortly!</h2>
<?php
	}
	else {
		$mode_allowed = array("username", "password");

		if(isset($_GET["mode"]) === true && in_array($_GET["mode"], $mode_allowed)) {
			if(isset($_POST["email"]) === true && empty($_POST["email"]) === false) {
				if(email_exists($_POST["email"]) === true) {
					recover($_GET["mode"], $_POST["email"]);
					header("Location: $linkToALL/recover.php?success");
                    exit();
				}
				else {
					echo "<p class='error_recover'>Oops, we couldn't find that email address!</p>";
				}
			}
?>
		<form class="form-horizontal recover_form" method="POST">
            <div class="form-group form-group-default">
                <div class="row">
                    <div class="col-md-4">
                         <span class="form_span">Please enter your email address:</span>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
				<input type="submit" class="btn btn-default" value="Recover">
            </div>
		</form>
	<?php 
		}
		else {
			header("Location: index.php");
			exit();
		}
	}
	include("assets/inc/footer.inc.php");
?>
