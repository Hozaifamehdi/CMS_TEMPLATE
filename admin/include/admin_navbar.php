<?php
    session_start();
?>

<?php
$user_name;
if (isset($_SESSION['user_name'])) {
    $user_name = $_SESSION['user_name'];
}
?>


<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Admin</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <?php 
            // This is used to show numbers of users online in this website
            
                $No_of_users_online = "SELECT users_online FROM `users` WHERE `users_online` = 1";
                $result_no_of_users_online = mysqli_query($isconnect, $No_of_users_online);
                $count = mysqli_num_rows($result_no_of_users_online);
            ?>

            <li><a><?php echo $count.' users Online';?></a></li>

            <li><a href="../index.php">Home</a></li>

            <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_name; ?> <b
                        class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="../index.php?logout=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>

                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#posts-dashboard"><i
                            class="fa fa-fw fa-arrows-v"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="posts-dashboard" class="collapse">
                        <li>
                            <a href="posts.php?source=100">Add posts</a>
                        </li>
                        <li>
                            <a href="posts.php">View Posts</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="catagories.php"><i class="fa fa-fw fa-desktop"></i> Categories</a>
                </li>
                <li>
                    <a href="comment.php"><i class="fa fa-fw fa-wrench"></i> Comments</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i
                            class="fa fa-fw fa-arrows-v"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="users.php?add_new_user=1">Add new user</a>
                        </li>
                        <li>
                            <a href="users.php?add_new_user=2">View all user</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-dashboard"></i> Profile</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>