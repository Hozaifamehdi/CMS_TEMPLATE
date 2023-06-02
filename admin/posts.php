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
                        <h3 class="page-header">
                            All posts
                        </h3>

                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <strong>
                                        <td>Id</td>
                                        <td>Author</td>
                                        <td>Title</td>
                                        <td>Content</td>
                                        <td>Catagory</td>
                                        <td>Image</td>
                                        <td>Tags</td>
                                        <td>Status</td>
                                        <td>Comment</td>
                                        <td>Date</td>
                                    </strong>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $posts_query = "select * from posts";
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
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $Id; ?>
                                        </td>
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