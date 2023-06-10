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

            <?php

                if(isset($_SESSION['user_name']) && isset($_SESSION['user_status'])){
                    $user_name=$_SESSION['user_name'];
                    echo "<h1 class='page-header'>
                    Sorry $user_name Admin 
                    <small>
                    blocked your account please contact on this email id
                    </small>
                    </h1>";
                    session_destroy();
                }

                elseif(isset($_SESSION['user_name'])){
                    $user_name=$_SESSION['user_name'];
                    echo "<h1 class='page-header'>
                    Welcome $user_name
                    <small>
                        you are login
                    </small>
                    </h1>";
                }
                
                elseif(isset($_SESSION['wrong'])){

                    echo "<h1 class='page-header'>
                    Wrong email or password!
                    <small>
                        Try again
                    </small>
                    </h1>";
                    session_destroy();
                }
            ?>

            <!-- Php for data featching from database -->

            <?php
            $post_query = "select * from posts";

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
                        // $year=$row_time.substr
                        // $date;
                        // $month;
                        // $year;
                        // switch ($month) {
                        //     case '1':
                        //         # code...
                        //         break;
                        //     case '2':
                        //         # code...
                        //         break;
                        //     case '3':
                        //         # code...
                        //         break;
                        //     case '4':
                        //         # code...
                        //         break;
                        //     case '5':
                        //         # code...
                        //         break;
                        //     case '6':
                        //         # code...
                        //         break;
                        //     case '7':
                        //         # code...
                        //         break;
                        //     case '8':
                        //         # code...
                        //         break;
                        //     case '9':
                        //         # code...
                        //         break;
                        //     case '10':
                        //         # code...
                        //         break;
                        //     case '11':
                        //         # code...
                        //         break;
                        //     case '12':
                        //         # code...
                        //         break;
                        // }
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

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
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