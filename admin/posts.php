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
                <?php
                if (isset($_GET['source'])) {
                    $source = $_GET['source'];
                } else {
                    $source = " ";
                }

                switch ($source) {

                    // IT is used to redirect the the add_post.php file
                

                    case '100':
                        include("include/add_posts.php");
                        break;

                    // Default is used to show all the post
                
                    default:
                        // include("include/gets_all_posts.php");
                        ?>
                        <?php
                        if (isset($_GET['delete'])) {
                            $del = $_GET['delete'];

                            $delete_query = "DELETE FROM `posts` WHERE `posts`.`post_id` = $del";

                            $delete_result = mysqli_query($isconnect, $delete_query);

                            if ($delete_result) {
                                echo "<h2>Posts deleted sucessfully</h2>";
                            } else {
                                echo "<h2>Error! </h2><h3>try again</h3> ";
                            }
                        }
                        ?>



                        <?php
                        if (isset($_GET['edit'])) {
                            include("include/edit_posts.php");
                        }
                        ?>


                        <form action="#" method="post">
                            <select name="choice" style="padding:7px 2px;">
                                <option value="All">All</option>
                                <option value="Published">Published</option>
                                <option value="Unpublished">Unpublished</option>
                            </select>
                            <button name="post_submit_choice" class="btn btn-primary">Get posts</button>
                        </form>





                        <h3 class="">
                            All
                            <?php
                            if (isset($_SESSION['post_choice'])) {

                                $posts_choice = $_SESSION['post_choice'];

                                switch ($posts_choice) {
                                    case 'Published':
                                        echo " published posts";
                                        break;

                                    case 'Unpublished':
                                        echo " unpublished posts";
                                        break;

                                    default:
                                        echo " posts";
                                        break;
                                }

                            } else {
                                echo "posts";
                            }
                            ?>
                        </h3>

                        <!-- Adding choice function to select as published unpublished and all -->
                        <?php
                        $posts_query = "select * from posts";

                        if (isset($_POST['post_submit_choice'])) {
                            $post_choice = $_POST['choice'];

                            switch ($post_choice) {
                                case 'Published':
                                    $posts_query = "select * from posts where post_status=1";
                                    $_SESSION['post_choice'] = $post_choice;

                                    break;

                                case 'Unpublished':
                                    $posts_query = "select * from posts where post_status=0";
                                    $_SESSION['post_choice'] = $post_choice;
                                    break;

                                default:
                                    $posts_query = "select * from posts";
                                    $_SESSION['post_choice'] = $post_choice;
                                    break;
                            }

                        }
                        ?>


                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <strong>
                                        <!-- <td>Id</td> -->
                                        <td>Author</td>
                                        <td>Title</td>
                                        <td>Content</td>
                                        <td>Catagory</td>
                                        <td>Image</td>
                                        <td>Tags</td>
                                        <td>Status</td>
                                        <td>Comment</td>
                                        <td>Date</td>
                                        <td>Views</td>
                                        <td>Edit</td>
                                        <td>Delete</td>
                                    </strong>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $result = mysqli_query($isconnect, $posts_query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $Id = $row['post_id'];
                                    $Author = $row['post_author'];
                                    $Title = $row['post_title'];
                                    $Content = $row['post_content'];
                                    $Catagory = $row['post_catagory_id'];
                                    $Image = $row['post_image'];
                                    $Tags = $row['post_tag'];
                                    $Status = $row['post_status'];
                                    $Comment = $row['post_comment'];
                                    $Date = $row['post_time'];
                                    $visit= $row['post_visit_counts'];
                                    ?>
                                    <tr>
                                        <!-- <td>
                                            <?php // echo $Id; ?>
                                        </td> -->
                                        <td>
                                            <?php echo $Author; ?>
                                        </td>
                                        <td>
                                            <?php echo $Title; ?>
                                        </td>
                                        <td>
                                            <?php echo $Content; ?>
                                        </td>
                                        <td>
                                            <?php echo $Catagory; ?>
                                        </td>
                                        <?php echo "<td><img class='img-responsive' src='../image/$Image'></td>" ?>
                                        <!-- <td><img src="images/<?php echo '$Image'; ?>"></td> -->
                                        <td>
                                            <?php echo $Tags; ?>
                                        </td>
                                        <td>
                                            <?php echo $Status; ?>
                                        </td>
                                        <td>
                                            <?php echo $Comment; ?>
                                        </td>
                                        <td>
                                            <?php echo $Date; ?>
                                        </td>
                                        <td>
                                            <?php echo $visit; ?>
                                        </td>
                                        <td>
                                            <a href="posts.php?edit=<?php echo $Id; ?>">Edit</a>
                                        </td>
                                        <td>
                                            <a href="posts.php?delete=<?php echo $Id; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php

                        break;
                }
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