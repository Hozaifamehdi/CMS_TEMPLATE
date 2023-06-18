<!-- Header  -->
<?php
include("include/admin_header.php");
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


                <!-- This portion of code is used to redirect to edit_user_infor.php page to    "edit user information"   -->
                <?php

                if (isset($_GET['edit'])) {
                    $user_id = $_GET['edit'];
                    ?>
                    <h1 class="page-header">
                        Update users
                        <small>information</small>
                    </h1>
                    <?php
                    include("include/edit_user_info.php");
                }
                ?>
                <!-- code end -->

                <?php

                if (isset($_GET['add_new_user'])) {
                    $mysource = $_GET['add_new_user'];

                    switch ($mysource) {

                        case '1':
                            // This code is used to include a add_new_user.php page to add new users in this page. 
                            ?>
                            <h1 class="page-header">
                                New
                                <small>User</small>
                            </h1>
                            <?php
                            include("include/add_new_user.php");
                            break;
                        // code end


                        default:
                            ?>

                            <h1 class="page-header">
                                All user
                                <small>Database</small>
                            </h1>


                            <!-- This portion of code is used to delete a user information -->
                            <?php

                            if (isset($_GET['delete'])) {   
                                if(isset($_SESSION['user_role'])){
                                    
                                    $user_id = $_GET['delete']; // user_id
                                    $delete_user_id = "DELETE FROM `users` WHERE `users`.`user_id` = $user_id"; // query to delete user_id
                                    $result_delete_user_id = mysqli_query($isconnect, $delete_user_id); // it return the result user_id delete or not
                                                        
                                    if ($result_delete_user_id) {

                                        echo "<h1 class='page-header'>
                                        $user_id deleted 
                                        <small>Sucessfully</small></h1>";

                                    } else {

                                        echo "<h2 class='page-header'>
                                        $user_id not delete sucessfully</h2> 
                                        <small>Try again!</small>";
                                    }                                                                 

                                }
                            }
                            ?>
                            <!-- code end -->



                            <!-- This piece of code is used to change the status of users  -->
                            <?php
                            if (isset($_GET['status'])) {

                                $user_status = $_GET['status'];
                                $user_id = $_GET['user_id'];

                                if ($user_status == 0) {

                                    $change_status = "UPDATE `users` SET `user_status` = '1' WHERE `users`.`user_id` = $user_id";

                                    $change_status_result = mysqli_query($isconnect, $change_status);

                                    if ($change_status_result) {
                                        echo "<h2>Id $user_id approve sucessfully</h2>";
                                        // include("users.php?add_new_user=2");
                                    } else {
                                        echo "<h2>Error! </h2><h3>try again</h3> ";
                                    }
                                } else {
                                    $change_status = "UPDATE `users` SET `user_status` = '0' WHERE `users`.`user_id` = $user_id";

                                    $change_status_result = mysqli_query($isconnect, $change_status);

                                    if ($change_status_result) {
                                        echo "<h2>Id $user_id Unapprove sucessfully</h2>";
                                        // include("users.php?add_new_user=2");
                
                                    } else {
                                        echo "<h2>Error! </h2><h3>try again</h3> ";
                                    }
                                }
                            }
                            ?>
                            <!-- Code end  -->



                            <!-- This portion of code used for view all users  -->
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <strong>
                                            <!-- <td>User Id </td> -->
                                            <td>Name</td>
                                            <td>Email id </td>
                                            <!-- <td>Password</td> -->
                                            <td>Phone No</td>
                                            <td>Image</td>
                                            <td>Role</td>
                                            <td>Status</td>
                                            <td>Approve/Unapprove</td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </strong>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php

                                    $users_query = "select * from users";
                                    $result = mysqli_query($isconnect, $users_query);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $user_id = $row['user_id'];
                                        $user_name = $row['user_name'];
                                        $user_email = $row['user_email'];
                                        // $user_password = $row['user_password'];
                                        $user_phone_no = $row['user_phone_no'];

                                        // If users phone number is empty in database
                                        if($user_phone_no == null){
                                            $user_phone_no = "NULL";
                                        }
                                        $user_image = $row['user_image'];
                                        $user_role = $row['user_role'];
                                        $user_status = $row['user_status'];
                                        ?>
                                        <tr>
                                            <!-- <td>
                                                <?php //echo $user_id; ?>
                                            </td> -->

                                            <td>
                                                <?php echo $user_name; ?>
                                            </td>

                                            <td>
                                                <?php echo $user_email; ?>
                                            </td>

                                            <!-- <td>
                                                <?php //echo $user_password; ?>
                                            </td> -->

                                            <td>
                                                <?php echo $user_phone_no; ?>
                                            </td>

                                            <?php echo "<td><img class='img-responsive' src='../image/$user_image' width='150px' height='150px'></td>" ?>

                                            <td>
                                                <?php echo $user_role; ?>
                                            </td>

                                            <td>
                                                <?php echo $user_status; ?>
                                            </td>

                                            <td>
                                                <a href="users.php?status=<?php echo $user_status; ?> & user_id=<?php echo $user_id; ?> & add_new_user=2">Approve/Unapprove</a>
                                            </td>

                                            <td>
                                                <a href="users.php?edit=<?php echo $user_id; ?>">Edit</a>
                                            </td>

                                            <td>
                                                <a href="users.php?delete=<?php echo $user_id; ?>& add_new_user=2">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            break;
                        // code end
                    }
                }
                ?>
            </div>

        </div>
        <!-- /.row -->


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>