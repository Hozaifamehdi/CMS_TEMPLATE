<?php
$query_result;

if (isset($_POST["add_user"])) {

    $user_name = $_POST["user_name"];
    $user_name = mysqli_real_escape_string($isconnect, $user_name);
    $user_email = $_POST["user_email"];
    $user_email = mysqli_real_escape_string($isconnect, $user_email);
    $user_password = $_POST["user_password"];
    $user_password = mysqli_real_escape_string($isconnect, $user_password);
    $user_phone_no = $_POST["user_phone_no"];
    $user_phone_no = mysqli_real_escape_string($isconnect, $user_phone_no);
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    $user_role = $_POST["user_role"];
    $user_role = mysqli_real_escape_string($isconnect, $user_role);

    move_uploaded_file($user_image_temp, "../image/$user_image");

    $post_query = "INSERT INTO `users` (`user_name`, `user_email`, `user_password`, `user_phone_no`, `user_image`, `user_role`) VALUES ('$user_name', '$user_email', '$user_password', '$user_phone_no', '$user_image', '$user_role')";
    $query_result = mysqli_query($isconnect, $post_query);
    if ($query_result) {
        echo "
            <h1 class='page-header'>
            User added
            <small>Sucessfully</small>
            </h1>";

            // header("location : users.php?add_new_user=2 ");
    } else {
        echo "
            <h2 class='page-header'>
            Error! in inserting user information</h2> 
            <small>Try again!</small>";
    }
}
?>

<?php
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
}
?>

<form action="#" method="post" enctype="multipart/form-data">
    <div class="mb-6">
        <label for="User_name" class="form-label">User name</label>
        <input type="text" class="form-control" id="user_name" aria-describedby="emailHelp" required="required"
            name="user_name">
    </div>
    <div class="mb-6">
        <label for="user_email" class="form-label">User Email</label>
        <input type="email" class="form-control" id="user_password" aria-describedby="emailHelp" required="required"
            name="user_email">
    </div>

    <div class="mb-6">
        <label for="user_password" class="form-label">User password</label>
        <input type="password" class="form-control" id="user_password" aria-describedby="emailHelp" required="required"
            name="user_password">
    </div>

    <div class="mb-6">
        <label for="user_phone_no" class="form-label">User Phone No</label>
        <input type="text" class="form-control" id="user_phone_no" aria-describedby="emailHelp" required="required"
            name="user_phone_no">
    </div>

    <div class="mb-6">
        <label for="user_image" class="form-label">User Image</label>
        <input type="file" name="user_image">
    </div>

    <br />

    <div class="mb-6">
        <label for="user_role" class="form-label">User role </label>
        <!-- <input type="text" class="form-control" id="user_role" aria-describedby="emailHelp" required="required"
            name="user_role"> -->

        <select name="user_role" class="form-control">
            <option value="Admin">Admin</option>
            <option value="subscriber">subscriber</option>
        </select>
    </div>
    <br />

    <div class="form-group">
        <button class="btn btn-primary" name="add_user">Add user</button>
    </div>
</form>