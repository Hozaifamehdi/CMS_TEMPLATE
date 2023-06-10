<?php
      include("../include/db.php");

?>

<?php
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];

    $query = "SELECT * FROM `users` WHERE user_id='$editId'";

    $user_edit_result = mysqli_query($isconnect, $query);

    $row = mysqli_fetch_assoc($user_edit_result);

    $user_name = $row['user_name'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
    $user_phone_no = $row['user_phone_no'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];

}
?>

<?php
// $query_result;

if (isset($_POST["edit_post"])) {

    $query_result;
    $user_id=$_GET['edit'];
    
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_phone_no = $_POST['user_phone_no'];
    // $user_image = $row['user_image'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST['user_role'];

    if(!$user_image){
        $image_query = "select * from users where user_id=$user_id";
        $image_query=mysqli_query($isconnect, $image_query);

        $row=mysqli_fetch_assoc($image_query);
        $user_image=$row['user_image'];
    }
    move_uploaded_file($user_image_temp, "../image/$user_image");

    $user_query = "UPDATE `users` SET `user_name` = '$user_name', `user_email` = '$user_email', `user_password`='$user_password', `user_phone_no` = '$user_phone_no', `user_image`= '$user_image',`user_role` = '$user_role' WHERE `users`.`user_id` = '$user_id'";

    $user_query_result = mysqli_query($isconnect, $user_query);
}
?>

<?php

if (isset($_POST['edit_post'])) {
    if ($user_query_result) {
        echo "
            <h1 class='page-header'>
            Post Edit
            <small>Sucessfully</small>
            </h1>";
            header("location:users.php?add_new_user=2");

    } else {
        echo "
            <h2 class='page-header'>
            Data not post sucessfully</h2> 
            <small>Try again!</small>";
    }
}
?>


<form action="#" method="post" enctype="multipart/form-data">
    <div class="mb-6">
        <label for="user_name" class="form-label">User name</label>
        <input type="text" class="form-control" id="user_name" aria-describedby="emailHelp" required="required"
            name="user_name" value="<?php echo $user_name; ?>">
    </div>

    <div class="mb-6">
        <label for="user_email" class="form-label">User email</label>
        <input type="email" class="form-control" id="user_email" aria-describedby="emailHelp" required="required"
            name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="mb-6">
        <label for="user_password" class="form-label">User Password</label>
        <input type="password" class="form-control" id="user_password" aria-describedby="emailHelp" required="required"
            name="user_password" value="<?php echo $user_password; ?>">
    </div>

    <div class="mb-6">
        <label for="user_phone_no" class="form-label">User Phone No</label>
        <input type="text" class="form-control" id="user_phone_no" aria-describedby="emailHelp" required="required"
            name="user_phone_no" value="<?php echo $user_phone_no; ?>">
    </div>

    <br />

    <div><img src="../image/<?php echo $user_image; ?>" width="200px"></div>

    <div class="mb-6">
        <label for="user_image" class="form-label">User image</label>
        <input type="file" name="user_image" value="../image/<?php echo $user_image; ?>">
    </div>

    <div class="mb-6">
        <label for="user_role" class="form-label">User role </label>
        <!-- <input type="text" class="form-control" id="user_role" aria-describedby="emailHelp" required="required"
            name="user_role"> -->

        <select name="user_role" class="form-control" value="<?php echo'$user_role'; ?>">
            <option value="Admin" <?php $admin='Admin'; if ($user_role ==$admin) {
                       echo 'selected=selected';
                   } ?> >Admin</option>
            <option value="Sub-admin" <?php $admin='Sub-admin'; if ($user_role ==$admin) {
                       echo 'selected=selected';
                   } ?>>Sub-admin</option>
            <option value="Employee" <?php $admin='Employee'; if ($user_role ==$admin) {
                       echo 'selected=selected';
                   } ?>>Employee</option>

            <option value="subscriber" <?php $admin='subscriber'; if ($user_role ==$admin) {
                        echo 'selected=selected';
                   } ?>>subscriber</option>
        </select>
    </div>


    <br />

    <div class="form-group">
        <button class="btn btn-primary" name="edit_post">Update User detail</button>
    </div>
</form>