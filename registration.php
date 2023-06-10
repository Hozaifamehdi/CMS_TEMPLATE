<?php include "include/db.php"; ?>
<?php include "include/header.php"; ?>


<!-- Navigation -->

<?php include "include/navigation.php"; ?>


<?php
if (isset($_POST['submit'])) {
    
    $username = $_POST['username'];
    $username= mysqli_real_escape_string($isconnect, $username);
    $useremail = $_POST['email'];
    $useremail= mysqli_real_escape_string($isconnect, $useremail);
    $password = $_POST['password'];

    $password= mysqli_real_escape_string($isconnect, $password);
    $insert_registration_data = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`) VALUES ('$username', '$useremail', '$password')";

    $registration_result = mysqli_query($isconnect, $insert_registration_data);
}

if (isset($_POST['submit'])) {
    if (!$registration_result) {
        ?>
        
        <!-- Page Content -->
        <div class="container">

            <section id="login">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">

                            <?php
                                echo "<h3>Email address already there!</h3>";
                            }else{

                                echo"<h3>Your Id created sucessfully</h3>";
                            }
                        }
                    ?>
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "include/footer.php"; ?>