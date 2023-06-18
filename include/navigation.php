<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">HOME</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php
                $query = "select * from catagory";
                $category_query = mysqli_query($isconnect, $query);

                while ($row = mysqli_fetch_assoc($category_query)) {
                    $cat_title = $row['cat_title'];
                    echo "<li><a href='search.php?cat_title=$cat_title'> $cat_title </a></li>";
                }
                ?>

                <?php
                if (isset($_SESSION['user_name']) && !isset($_SESSION['user_status'])) {

                    $user_email = $_SESSION['user_email'];

                    $user_role_query = "SELECT * FROM `users` WHERE `user_email` LIKE '$user_email'";

                    // SELECT * FROM `users` WHERE `user_email` LIKE '$user_email';
                
                    $user_role_result = mysqli_query($isconnect, $user_role_query);

                    $user_role_row = mysqli_fetch_assoc($user_role_result);
                    $user_role = $user_role_row['user_role'];

                    if ($user_role == 'subscriber') {
                        ?>

                        <li><a href="admin/user_profile.php">Profile</a></li>

                        <?php
                    } elseif ($user_role == 'Admin') {
                        $_SESSION['user_role']=$user_role;
                        ?>

                        <li><a href="admin?user_role=<?php echo $user_role; ?> & Admin=<?php echo $user_email ?>">Admin</a></li>
                        <?php

                    }
                }

                ?>

                <!-- <li><a href="admin">Admin</a></li> -->

                <li><a href="registration.php">Registration</a></li>
                <?php
                if (isset($user_role)) {
                    ?>
                    <li>
                        <a href="index.php?logout=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                    <?php
                } ?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>