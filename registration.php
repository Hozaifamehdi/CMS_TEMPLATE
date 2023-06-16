<!-- In this registration file 1 thing must be added which is if user phone number or email is duplicate then it must throw message and user should understand this message and respond on the basis of message -->

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

    // $rand_salt = "select randsalt from users";
    // $rand_salt_query= mysqli_query($isconnect, $rand_salt);
    // if(!$rand_salt_query){
    //     die("Query failed ". mysqli_error($isconnect));
    // }

    // $row = mysqli_fetch_array($rand_salt_query);
    // $salt= $row['randsalt'];

    // $password = crypt($password, $salt);

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
                    <!-- <div class="row"> -->
                        
                    <!-- <div> -->
                    <div class="form-wrap" style="padding:20px 20vw">
                    <div class="col-xs-6 col-xs-offset-3">

                            <?php
                                echo "<h3>Email address already there!</h3>";
                            }else{

                                echo"<h3>Your Id created sucessfully</h3>";
                            }
                        }
                    ?>
                    </br>
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div class="form-group">
                                <label for="username" class="sr-only">username</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter Desired Username" required="required">
                            </div>
                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="somebody@example.com" required="required">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control"
                                    placeholder="Password" required="required">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block"
                                value="Register">
                        </form>
                        <br/>
                        <br/>
                        C all copyright reserved
                    </div>
                    <!-- </div> -->
                </div> <!-- /.col-xs-12 -->
            <!-- </div> /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>


    <?php include "include/footer.php"; ?>