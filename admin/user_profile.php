<!-- Header  -->
<?php
    // session_start();
?>

<?php
    include("include/admin_header.php");
?>

<?php
    include("../include/db.php");
?>

<!-- Navigation bar -->
<?php
    include("include/user_navbar.php");
?>


<?php
// $query_result;
if (isset($_GET["user_id"])) {

    if (isset($_POST["update_post"])) {

        $query_result;
        $user_id = $_GET['user_id'];
        $user_name = $_POST['user_name'];      
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_phone_no = $_POST['user_phone_no'];
        // $user_image = $row['user_image'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        // $user_role = $_POST['user_role'];

        if (!$user_image) {
            $image_query = "select * from users where user_id=$user_id";
            $image_query = mysqli_query($isconnect, $image_query);

            $row = mysqli_fetch_assoc($image_query);
            $user_image = $row['user_image'];
        }
        move_uploaded_file($user_image_temp, "../image/$user_image");

        $my_query = "UPDATE `users` SET `user_name` = '$user_name', `user_email` = '$user_email', `user_password`='$user_password', `user_phone_no` = '$user_phone_no', `user_image`= '$user_image' WHERE `users`.`user_id` = '$user_id'";

        $my_query_result = mysqli_query($isconnect, $my_query);
    }
}

?>


<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <?php

                if (isset($_POST['update_post'])) {
                    if ($my_query_result) {
                        echo "<h2 class='page-header'>
        Profile Updates sucessfully</h2>";
                        // header("location:users.php?add_new_user=2");
                
                    } else {
                        echo "<h2 class='page-header'>
        Error please try again!</h2>";
                    }
                } else { ?>
                    <h2 class="page-header">
                        Profile
                    </h2>
                    <?php
                }
                ?>

                <?php
                if (isset($_SESSION['user_email'])) {

                    $user_email = $_SESSION['user_email'];

                    $profile_query = "SELECT * FROM `users` WHERE `user_email` = '$user_email'";

                    // $profile_query = "select * from users where user_email=$user_email";
                
                    $profile_query_result = mysqli_query($isconnect, $profile_query);

                    $profile_row = mysqli_fetch_assoc($profile_query_result);

                    $user_id = $profile_row['user_id'];
                    $user_name = $profile_row['user_name'];
                    $user_email = $profile_row['user_email'];
                    $user_password = $profile_row['user_password'];
                    $user_phone_no = $profile_row['user_phone_no'];
                    $user_image = $profile_row['user_image'];
                    $user_role = $profile_row['user_role'];
                    ?>

                    <form action="user_profile.php?user_id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-6">
                            <label for="user_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="user_name" aria-describedby="emailHelp"
                                required="required" name="user_name" value="<?php echo $user_name; ?>">
                        </div>

                        <div class="mb-6">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="user_email" aria-describedby="emailHelp"
                                required="required" name="user_email" value="<?php echo $user_email; ?>">
                        </div>

                        <div class="mb-6">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user_password" aria-describedby="emailHelp"
                                required="required" name="user_password" value="<?php echo $user_password; ?>">
                        </div>

                        <div class="mb-6">
                            <label for="user_phone_no" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="user_phone_no" aria-describedby="emailHelp"
                                required="required" name="user_phone_no" value="<?php echo $user_phone_no; ?>">
                        </div>

                        <br />

                        <div><img src="../image/<?php echo $user_image; ?>" width="200px"></div>

                        <div class="mb-6">
                            <label for="user_image" class="form-label">Image</label>
                            <input type="file" name="user_image" value="../image/<?php echo $user_image; ?>">
                        </div>

                        <div class="mb-6">
                            <label for="user_role" class="form-label">User role </label>
                            <!-- <input type="text" class="form-control" id="user_role" aria-describedby="emailHelp" required="required"
            name="user_role"> -->

                            <select class="form-control">
                                <option>
                                    <?php echo $user_role; ?>
                                </option>
                            </select>
                        </div>

                        <br />

                        <div class="form-group">
                            <button class="btn btn-primary" name="update_post">Update details</button>
                        </div>
                    </form>

                <?php } ?>
            </div>
        </div>

        <!-- /.row -->

    </div>
</div>