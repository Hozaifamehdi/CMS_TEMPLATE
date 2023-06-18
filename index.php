<!-- to connect database -->
<?php
session_start();
?>

<?php
include("include/db.php");
?>
<?php
include("include/header.php");
?>

<!-- Navigation -->
<?php
include("include/navigation.php");
?>


<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h3>
                <?php
                if (isset($_GET['logout'])) {

                    // This piece of code is used to update data that uses are now offline
                    $user_email = $_SESSION['user_email'];
                    $offline_query= "UPDATE `users` SET `users_online` = '0' WHERE `users`.`user_email` = '$user_email'";
                    $result_offline_query = mysqli_query($isconnect, $offline_query);
                    // code end here

                    session_destroy();
                    echo "You are logout";
                    header("location: index.php");
                } ?>
            </h3>

            <?php

            if (isset($_SESSION['user_name']) && isset($_SESSION['user_status'])) {
                $user_name = $_SESSION['user_name'];
                echo "<h1 class='page-header'>
                    Sorry $user_name Admin 
                    <small>
                    blocked your account please contact on this email id
                    </small>
                    </h1>";
                session_destroy();
            } elseif (isset($_SESSION['user_name'])) {
                $user_name = $_SESSION['user_name'];
                echo "<h1 class='page-header'>
                    Welcome $user_name
                    <small>
                        you are login
                    </small>
                    </h1>";
            } elseif (isset($_SESSION['wrong'])) {

                echo "<h1 class='page-header'>
                    Wrong email or password!
                    <small>
                        Try again
                    </small>
                    </h1>";
                session_destroy();
            }
            ?>

            <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
                $page1=$page-1;
                $page1=$page1 * 5;
            }else{
                $page1=0;
            }
            ?>

            <!-- Php for data featching from database -->

            <?php
            $post_query = "select * from posts";

            $post_count_fetch = mysqli_query($isconnect, $post_query);
            $post_count = mysqli_num_rows($post_count_fetch);
            $post_count = ceil($post_count / 5);
            
            $post_query = "SELECT * FROM `posts` LIMIT $page1, 5";
            $post_query_fetch = mysqli_query($isconnect, $post_query);

            while ($row = mysqli_fetch_assoc($post_query_fetch)) {

                $row_id = $row['post_id'];
                $row_title = $row['post_title'];
                $row_author = $row['post_author'];
                $row_content = substr($row['post_content'], 0, 150);
                $row_time = $row['post_time'];
                $row_image = $row['post_image'];
                $row_status = $row['post_status'];

                if ($row_status == 1) {
                    ?>
                    <h2>
                        <a href="search.php?individual_post=<?php echo $row_id; ?>">
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
                    <a href="search.php?individual_post=<?php echo $row_id; ?>">
                        <img class="img-responsive" src="image/<?php echo $row_image; ?>" alt="" width="800px" height="350px">
                    </a>
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
            } ?>

            <!-- First Blog Post -->

            <!-- Pager
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul> -->

            <ul class="pager">
                <?php
                for ($i = 1; $i <= $post_count; $i++) {
                    echo "<li><a href='index.php?page=$i'>$i</a></li>";
                } ?>
            </ul>

        </div>
        <!-- Sidebar -->
        <?php
        include("include/sidebar.php");
        ?>

        <!-- Footer -->
        <?php
        include("include/footer.php");
        ?>