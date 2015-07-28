                <div id="logged_in_box">
                    <h2 id="hello">Hello <?php echo $user_data['first_name']; ?>!</h2>
                    <ul id = "status_logged_in">
                        <li class="logged_in_btn"><a href="logout.php"><button type="button" name="logout" class="btn btn-default">Log Out</button></a></li>
                        <li class="logged_in_btn"><a href="changepassword.php"><button type="button" name="change_password" class="btn btn-default">Change password</button></a></li>
                    </ul>
                </div>