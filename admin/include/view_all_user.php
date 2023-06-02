<?php
    // include("../include/db.php");

    $isconnect=mysqli_connect("localhost", "root", "", "cms");
?>

<?php

    if(isset($_GET['delete'])){
        $del=$_GET['delete'];

        $delete_query="DELETE FROM `posts` WHERE `posts`.`post_id` = $del";

        $delete_result=mysqli_query($isconnect, $delete_query);

        if($delete_result){
            echo "<h2>Posts delete sucessfully</h2>";
        }else{
            echo "<h2>Error! </h2><h3>try again</h3> ";
        }
    }
?>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <strong>
                <td>User Id </td>
                <td>Name</td>
                <td>Email id </td>
                <td>Password</td>
                <td>Phone No</td>
                <td>Image</td>
                <td>Role</td>
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
            $user_id= $row['user_id'];
            $user_name = $row['user_name'];
            $user_email = $row['user_email'];
            $user_password = $row['user_password'];
            $user_phone_no = $row['user_phone_no'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            ?>
            <tr>
                <td>
                    <?php echo $user_id; ?>
                </td>
                <td>
                    <?php echo $user_name; ?>
                </td>
                <td>
                    <?php echo $user_email; ?>
                </td>
                <td>
                    <?php echo $user_password; ?>
                </td>
                <td>
                    <?php echo $user_phone_no; ?>
                </td>
                <?php echo "<td><img class='img-responsive' src='../image/$user_image' width='150px' height='150px'></td>" ?>

                <td>
                    <?php echo $user_role; ?>
                </td>
                <td>
                    <a href="../users.php?edit=<?php echo $user_id;?>">Edit</a>
                </td>
                <td>
                    <a href="include/view_all_user.php?delete=<?php echo $user_id;?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>