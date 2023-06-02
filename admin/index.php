<!-- Header  -->
<?php
session_start();
?>
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
                <h1 class="page-header">
                    Welcome
                    <?php
                    if (isset($_SESSION['user_name'])) {
                        $user_name = $_SESSION['user_name'];
                        echo $user_name;
                    } ?>
                    <small>Hope you are well </small>
                </h1>

                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>

            </div>

        </div>



        <!-- /.row -->


        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                            <?php
                                $post_query="select * from posts";
                                $post_query_result=mysqli_query($isconnect, $post_query);
                                $post_counts=mysqli_num_rows($post_query_result);
                            ?>

                                <div class='huge'><?php echo $post_counts;  ?></div>
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                            <?php
                                $comments_query="select * from comment";
                                $comments_query_result=mysqli_query($isconnect, $comments_query);
                                $comments_counts=mysqli_num_rows($comments_query_result);
                            ?>




                                <div class='huge'><?php echo $comments_counts;  ?></div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comment.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>

                            <?php
                                $users_query="select * from users";
                                $users_query_result=mysqli_query($isconnect, $users_query);
                                $users_counts=mysqli_num_rows($users_query_result);
                            ?>


                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $users_counts;  ?></div>
                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>

                            <?php
                                $catagories_query="select * from catagory";
                                $catagories_query_result=mysqli_query($isconnect, $catagories_query);
                                $catagories_counts=mysqli_num_rows($catagories_query_result);
                            ?>

                            <div class="col-xs-9 text-right">
                                <div class='huge'><?php echo $catagories_counts;  ?></div>
                                <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="catagories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
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