<!-- to connect database -->
<?php
include("include/db.php");
?>
<?php
include("include/header.php");
?>

<?php

function comment_incriment($isconnect, $post_id)
{
    $fetch_no_of_comment = "select post_comment from posts where post_id=$post_id";

    $fetch_no_of_comment_result = mysqli_query($isconnect, $fetch_no_of_comment);

    $fetch_row = mysqli_fetch_assoc($fetch_no_of_comment_result);
    $comment_no = $fetch_row['post_comment'];
    $comment_no = $comment_no + 1;
    $post_comment_count = "UPDATE `posts` SET `post_comment` = '$comment_no' WHERE `posts`.`post_id` = $post_id";
    $post_comment_result = mysqli_query($isconnect, $post_comment_count);
}
?>

<!-- Navigation -->
<?php
include("include/navigation.php");
?>

<?php
if (isset($_POST['comment'])) {
    // $post_id=$_GET['post_id'];
    $post_id = $_GET['row_id'];
    $post_title = $_GET['row_title'];

    $user_name = $_POST['author_name'];
    $user_email = $_POST['email'];
    $user_comment = $_POST['post_comment'];



    $insert_comment_query = "INSERT INTO `comment` (`comment_post_id`, `comment_post_title`, `comment_author`, `comment_email`, `comment_content`) VALUES ('$post_id', '$post_title', '$user_name', '$user_email', '$user_comment')";
    $insert_query_result = mysqli_query($isconnect, $insert_comment_query);
    if ($insert_query_result) {
        comment_incriment($isconnect, $post_id);
    }
    header("location: search.php?individual_post=$post_id");
}
?>



<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <!-- Php for data featching from database -->

            <?php

            if (isset($_POST['submit'])) {

                $search = $_POST['search'];

                $query = "select * from posts where post_tag like '%$search%' ";

                $search_query = mysqli_query($isconnect, $query);

                if (!$search_query) {
                    die("Query failed " . mysqli_error($isconnect));
                } else {
                    $count = mysqli_num_rows($search_query);
                    if ($count == 0) {
                        echo "<H1>No result</H1>";

                    } else {

                        // $post_query = "select * from posts ";
            
                        // $post_query_fetch = mysqli_query($isconnect, $post_query);
            
                        while ($row = mysqli_fetch_assoc($search_query)) {
                            $row_id = $row['post_id'];
                            $row_title = $row['post_title'];
                            $row_author = $row['post_author'];
                            $row_content = substr($row['post_content'], 0, 150);
                            // $row_content = $row['post_content'];
                            $row_time = $row['post_time'];
                            $row_image = $row['post_image'];
                            $row_status = $row['post_status'];

                            if ($row_status == 1) {
                                ?>
                                <h2>
                                    <a href="#">
                                        <?php echo "$row_title" ?>
                                    </a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php">
                                        <?php
                                        echo "$row_author";
                                        ?>
                                    </a>
                                </p>

                                <p><span class="glyphicon glyphicon-time"></span>Posted on
                                    <?php
                                    echo "$row_time";
                                    ?>
                                </p>
                                <hr>
                                <img class="img-responsive" src="image/<?php echo $row_image; ?>" alt="" width="800px" height="350px">
                                <hr>
                                <p>
                                    <?php
                                    echo "$row_content";
                                    ?>
                                </p>
                                <a class="btn btn-primary" href="search.php?individual_post=<?php echo $row_id; ?>">Read More <span
                                        class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>

                                <?php
                            }
                        }
                        ?>

                    <?php } ?>

                <?php } ?>
            <?php } ?>


            <!-- update_my_post -->

            <?php
            if (isset($_GET['update_my_post'])) {

                $post_id = $_GET['update_my_post'];

                if (isset($_POST['comment'])) {
                    $post_comment = $_POST['post_comment'];
                    // Need table to posts comment;
                    $comment_query = "select * from posts where comment=$post_comment";
                    $comment_result = mysqli_query($isconnect, $comment_query);

                    //handling resubmission problem 
                    if($comment_result){
                        header("location:search.php?individual_post=$row_id");
                    }
                }


                $individual_query = "SELECT * FROM `posts` WHERE post_id=$post_id";

                $individual_result = mysqli_query($isconnect, $individual_query);

                $row = mysqli_fetch_assoc($individual_result);
                $row_id = $row['post_id'];
                $row_title = $row['post_title'];
                $row_catagory = $row['post_catagory_id'];
                $row_author = $row['post_author'];
                $row_content = $row['post_content'];
                $row_time = $row['post_time'];
                $row_image = $row['post_image'];
                $row_status = $row['post_status'];


                ?>
                <h2>
                    <a href="#">
                        <?php echo "$row_title" ?>
                    </a>
                </h2>
                <p class="lead">
                    by <a href="index.php">
                        <?php
                        echo "$row_author";
                        ?>
                    </a>
                </p>

                <p><span class="glyphicon glyphicon-time"></span>Posted on
                    <?php
                    echo "$row_time";
                    ?>
                </p>
                <hr>
                <img class="img-responsive" src="image/<?php echo $row_image; ?>" alt="" width="800px" height="350px">
                <hr>
                <p>
                    <?php
                    echo "$row_content";
                    ?>
                </p>

                <form action="search.php?row_id=<?php echo $row_id; ?> &row_title=<?php echo $row_title; ?>" method="POST">
                    <div class="mb-6">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" name="author_name" class="form-control" required="required"
                            placeholder="ramesh kumar">
                    </div>

                    <div class="mb-6">
                        <!-- <br/> -->
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required="required"
                            placeholder="rameshkumar@gmail.com">
                    </div>

                    <div class="mb-6">
                        <!-- <label for="email" class="form-label">Leave a comment</label> -->
                        <br />
                        <textarea name="post_comment" required="required" class="form-control" aria-describedby="emailHelp"
                            rows="4" placeholder="Leave a comment"></textarea>

                    </div>
                    <br />
                    <div class="form-group">
                        <button class="btn btn-primary" name="comment">Comment</button>
                    </div>
                </form>
                <hr />
                <?php

                $comment_query = "SELECT * FROM `comment` WHERE `comment_post_id`= '$row_id' AND `comment_status` = 1";

                $comment_result = mysqli_query($isconnect, $comment_query);

                while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                    $comment_author = $comment_row['comment_author'];
                    $comment_content = $comment_row['comment_content'];
                    $comment_date = $comment_row['comment_date'];
                    ?>

                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php echo $comment_author; ?>
                            <small>
                                <?php echo $comment_date; ?>
                            </small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                    <hr />
                    <?php
                }
            }
            ?>

            <!-- upadte_my_post -->



            <!-- individual post -->

            <?php
            if (isset($_GET['individual_post'])) {

                $post_id = $_GET['individual_post'];

                if (isset($_POST['comment'])) {
                    $post_comment = $_POST['post_comment'];
                    // Need table to posts comment;
                    $comment_query = "select * from posts where comment=$post_comment";
                    $comment_result = mysqli_query($isconnect, $comment_query);
                }


                $individual_query = "SELECT * FROM `posts` WHERE post_id=$post_id";

                $individual_result = mysqli_query($isconnect, $individual_query);

                $row = mysqli_fetch_assoc($individual_result);
                $row_id = $row['post_id'];
                $row_title = $row['post_title'];
                $row_catagory = $row['post_catagory_id'];
                $row_author = $row['post_author'];
                $row_content = $row['post_content'];
                $row_time = $row['post_time'];
                $row_image = $row['post_image'];
                $row_status = $row['post_status'];
                $post_visit_counts=$row['post_visit_counts'];
                if ($row_status == 1) {

                    // Counting number of visit in a post

                    $post_visit_counts=$post_visit_counts+1;

                    $post_visit_counts="UPDATE `posts` SET `post_visit_counts` = '$post_visit_counts' WHERE `posts`.`post_id` = $row_id";
                    $post_visit_query=mysqli_query($isconnect, $post_visit_counts);



                    ?>
                    <h2>
                        <a href="#">
                            <?php echo "$row_title" ?>
                        </a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php">
                            <?php
                            echo "$row_author";
                            ?>
                        </a>
                    </p>

                    <p><span class="glyphicon glyphicon-time"></span>Posted on
                        <?php
                        echo "$row_time";
                        ?>
                    </p>
                    <hr>
                    <img class="img-responsive" src="image/<?php echo $row_image; ?>" alt="" width="800px" height="350px">
                    <hr>
                    <p>
                        <?php
                        echo "$row_content";
                        ?>
                    </p>

                    <form action="search.php?row_id=<?php echo $row_id; ?> &row_title=<?php echo $row_title; ?>" method="POST">
                        <div class="mb-6">
                            <label for="author" class="form-label">Author</label>
                            <input type="text" name="author_name" class="form-control" required="required"
                                placeholder="ramesh kumar">
                        </div>

                        <div class="mb-6">
                            <!-- <br/> -->
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required="required"
                                placeholder="rameshkumar@gmail.com">
                        </div>

                        <div class="mb-6">
                            <!-- <label for="email" class="form-label">Leave a comment</label> -->
                            <br />
                            <textarea name="post_comment" required="required" class="form-control" aria-describedby="emailHelp"
                                rows="4" placeholder="Leave a comment"></textarea>

                        </div>
                        <br />
                        <div class="form-group">
                            <button class="btn btn-primary" name="comment">Comment</button>
                        </div>
                    </form>
                    <hr />
                    <?php

                    $comment_query = "SELECT * FROM `comment` WHERE `comment_post_id`= '$row_id' AND `comment_status` = 1";

                    $comment_result = mysqli_query($isconnect, $comment_query);

                    while ($comment_row = mysqli_fetch_assoc($comment_result)) {
                        $comment_author = $comment_row['comment_author'];
                        $comment_content = $comment_row['comment_content'];
                        $comment_date = $comment_row['comment_date'];
                        ?>

                        <div class="media-body">
                            <h4 class="media-heading">
                                <?php echo $comment_author; ?>
                                <small>
                                    <?php echo $comment_date; ?>
                                </small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                        <hr />
                        <?php
                    }
                }
            }
            ?>

            <!-- individual post -->


            <?php
            if (isset($_GET['cat_title'])) {
                $cat_title = $_GET['cat_title'];

                $cat_title_query = "select * from posts where post_catagory_id='$cat_title'";

                $cat_title_result = mysqli_query($isconnect, $cat_title_query);

                // $cat_row = mysqli_fetch_assoc($cat_title_result);
                $count=0;
                while ($cat_row = mysqli_fetch_assoc($cat_title_result)) {

                    $cat_id = $cat_row['post_id'];
                    $cat_title = $cat_row['post_title'];
                    $cat_author = $cat_row['post_author'];
                    $cat_content = substr($cat_row['post_content'], 0, 150);
                    $cat_time = $cat_row['post_time'];
                    $cat_image = $cat_row['post_image'];
                    $cat_status = $cat_row['post_status'];
                    if ($cat_status == 1) {
                        ?>
                        <h2>
                            <a href="#">
                                <?php echo "$cat_title" ?>
                            </a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php">
                                <?php
                                echo "$cat_author";
                                ?>
                            </a>
                        </p>

                        <p><span class="glyphicon glyphicon-time"></span>Posted on
                            <?php
                            echo "$cat_time";
                            ?>
                        </p>
                        <hr>
                        <img class="img-responsive" src="image/<?php echo $cat_image; ?>" alt="" width="800px" height="350px">
                        <hr>
                        <p>
                            <?php
                            echo "$cat_content";
                            ?>
                        </p>

                        <a class="btn btn-primary" href="search.php?individual_post=<?php echo $cat_id; ?>">Read More <span
                                class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                        <?php
                        $count=$count+1;
                    }
                }
                if($count==0){
                    ?>
                    <h3>No result</h3>
                    <hr/>
                    <?php
                }
            }
            ?>


            <!-- First Blog Post -->

            <!-- Pager -->
            <!-- <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul> -->

        </div>
        <!-- Sidebar -->
        <?php
        include("include/sidebar.php");
        ?>

        <!-- Footer -->
        <?php
        include("include/footer.php");
        ?>
    </div>
</div>