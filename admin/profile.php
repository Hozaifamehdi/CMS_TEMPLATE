<!-- Header  -->
<?php
session_start();
?>

<?php
include("include/admin_header.php");
?>

<?php
include("../include/db.php");
?>
<!-- Navigation bar -->
<?php
include("include/admin_navbar.php");
?>





<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">
                    Profile
                </h2>

                <?php
                // $query_result;
                ?>
                
                
                <?php
                if (isset($_SESSION['user_email'])) {

                    $user_email = $_SESSION['user_email'];

                    $profile_query="SELECT * FROM `users` WHERE `user_email` = '$user_email'";
                    
                    // $profile_query = "select * from users where user_email=$user_email";

                    $profile_query_result = mysqli_query($isconnect, $profile_query);
                
                    $profile_row = mysqli_fetch_assoc($profile_query_result);
                
                    $user_name = $profile_row['user_name'];
                    $user_email = $profile_row['user_email'];
                    $user_password = $profile_row['user_password'];
                    $user_phone_no = $profile_row['user_phone_no'];
                    $user_image = $profile_row['user_image'];
                    $user_role = $profile_row['user_role'];
                ?>

                <form action="#" method="post" enctype="multipart/form-data">
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
                                <?php echo "$user_role"; ?>
                            </option>
                        </select>
                    </div>


                    <br />

                    <div class="form-group">
                        <button class="btn btn-primary" name="edit_post">Update details</button>
                    </div>
                </form>

                <?php } ?>
            </div>
        </div>

        <!-- /.row -->

    </div>
</div>