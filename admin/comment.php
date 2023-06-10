<!-- Header  -->
<?php
include("include/admin_header.php");
?>

<!-- Navigation bar -->
<?php
include("include/admin_navbar.php");
?>

<?php
function comment_decriment($isconnect, $comment_post_id)
{
    $fetch_no_of_comment = "select post_comment from posts where post_id=$comment_post_id";

    $fetch_no_of_comment_result = mysqli_query($isconnect, $fetch_no_of_comment);

    $fetch_row = mysqli_fetch_assoc($fetch_no_of_comment_result);
    $comment_no = $fetch_row['post_comment'];
    $comment_no = $comment_no - 1;
    $post_comment_count = "UPDATE `posts` SET `post_comment` = '$comment_no' WHERE `posts`.`post_id` = $comment_post_id";
    $post_comment_result = mysqli_query($isconnect, $post_comment_count);
}
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">

                <?php
                if (isset($_GET['approve_status'])) {

                    $status_approve = $_GET['approve_status'];
                    $comment_id = $_GET['comment_id'];
                    if ($status_approve == 0) {

                        $change_status = "UPDATE `comment` SET `comment_status` = '1' WHERE `comment`.`comment_id` = $comment_id";
                        // $change_status="select * from comment where comment_id=$comment_id";
                        $change_status_result = mysqli_query($isconnect, $change_status);

                        if ($change_status_result) {
                            echo "<h2>Id $comment_id approve sucessfully</h2>";
                        } else {
                            echo "<h2>Error! </h2><h3>try again</h3> ";
                        }
                    }
                }


                if (isset($_GET['unapprove_status'])) {

                    $status_approve = $_GET['unapprove_status'];
                    $comment_id = $_GET['comment_id'];

                    if ($status_approve == 1) {

                        $change_status = "UPDATE `comment` SET `comment_status` = '0' WHERE `comment`.`comment_id` = $comment_id";
                        // $change_status="select * from comment where comment_id=$comment_id";
                        $change_status_result = mysqli_query($isconnect, $change_status);

                        if ($change_status_result) {
                            echo "<h2>Id $comment_id Unapprove sucessfully</h2>";
                        } else {
                            echo "<h2>Error! </h2><h3>try again</h3> ";
                        }
                    }
                }
                ?>


                <?php
                if (isset($_GET['delete'])) {
                    $del_id = $_GET['delete'];
                    $comment_post_id = $_GET['comment_post_id'];

                    $delete_comment_query = "DELETE FROM `comment` WHERE `comment`.`comment_id` = $del_id";

                    $delete_result = mysqli_query($isconnect, $delete_comment_query);

                    if ($delete_result) {
                        echo "<h2>Posts deleted sucessfully</h2>";

                        comment_decriment($isconnect, $comment_post_id);


                    } else {
                        echo "<h2>Error! </h2><h3>try again</h3>";
                    }
                }
                ?>



                <?php
                $comment_query = "select * from comment";

                if (isset($_POST['submit_choice'])) {

                    $comment_choice = $_POST['choice'];

                    switch ($comment_choice) {
                        case 'Published':
                            $comment_query = "select * from comment where comment_status=1";
                            $_SESSION['choice'] = $comment_choice;
                            break;

                        case 'Unpublished':
                            $comment_query = "select * from comment where comment_status=0";
                            $_SESSION['choice'] = $comment_choice;
                            break;

                        default:
                            $comment_query = "select * from comment";
                            $_SESSION['choice'] = $comment_choice;
                            break;
                    }
                    // header("location:comment.php");
                
                }
                ?>


                <form action="#" method="post">
                    <select name="choice" style="padding:7px 2px;">
                        <option value="All">All</option>
                        <option value="Published">Published</option>
                        <option value="Unpublished">Unpublished</option>
                    </select>
                    <button name="submit_choice" class="btn btn-primary">Get comments</button>
                </form>

                <h3 class="">
                    All
                    <?php
                    if (isset($_SESSION['choice'])) {

                        $comment_choice = $_SESSION['choice'];

                        switch ($comment_choice) {
                            case 'Published':
                                echo " published comments";
                                break;

                            case 'Unpublished':
                                echo " unpublished comments";
                                break;

                            default:
                                echo " comments";
                                break;
                        }

                    } else {
                        echo "comments";
                    }
                    ?>
                </h3>



                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <strong>
                                <!-- <td>Id</td> -->
                                <td>Post Id</td>
                                <td>Post title</td>
                                <td>Author</td>
                                <td>Email</td>
                                <td>Comment</td>
                                <td>Status</td>
                                <td>Date</td>
                                <td>Approve</td>
                                <td>Unapprove</td>
                                <td>Delete</td>
                            </strong>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $comment_result = mysqli_query($isconnect, $comment_query);

                        while ($row = mysqli_fetch_assoc($comment_result)) {
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row["comment_post_id"];
                            $comment_post_title = $row['comment_post_title'];
                            // $comment_post_title="select * from posts where post_id='$comment_id'";
                            $comment_Author = $row['comment_author'];
                            $comment_email = $row['comment_email'];
                            $comment_content = $row['comment_content'];
                            $comment_status = $row['comment_status'];
                            // if($comment_status==1){
                            //     $comment_status="Approve";
                            // }else{
                            //     $comment_status="Unapprove";
                            // }
                            $comment_date = $row['comment_date'];
                            ?>
                            <tr>
                                <!-- <td>
                                    <a href="../search.php?individual_post=<?php //echo $comment_post_id; ?>"><?php // echo $comment_id; ?></a>
                                </td> -->
                                <td>
                                    <a href="../search.php?individual_post=<?php echo $comment_post_id; ?>"><?php echo $comment_post_id; ?></a>
                                </td>
                                <td>
                                    <a href="../search.php?individual_post=<?php echo $comment_post_id; ?>"><?php echo $comment_post_title; ?></a>
                                </td>

                                <td>
                                    <?php echo $comment_Author; ?>
                                </td>
                                <td>
                                    <?php echo $comment_email; ?>
                                </td>

                                <td>
                                    <?php echo $comment_content; ?>
                                </td>
                                <td>
                                    <?php echo $comment_status; ?>
                                </td>
                                <td>
                                    <?php echo $comment_date; ?>
                                </td>

                                <td><a
                                        href="comment.php?approve_status=<?php echo $comment_status; ?> &comment_id=<?php echo $comment_id; ?>">Approve</a>
                                </td>

                                <td><a
                                        href="comment.php?unapprove_status=<?php echo $comment_status; ?> &comment_id=<?php echo $comment_id; ?>">Unapprove</a>
                                </td>

                                <td>
                                    <a
                                        href="comment.php?delete=<?php echo $comment_id; ?>&comment_post_id=<?php echo $comment_post_id; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <?php
                ?>
            </div>
        </div>
        <!-- /.row -->

        <!-- This code of php is used to show catagories in website -->

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