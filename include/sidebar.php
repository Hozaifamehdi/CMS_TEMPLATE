<?php
include("include/db.php");
?>
<!-- Blog Sidebar Widgets Column -->
<div class="col-md-4">



<!-- Login form  -->
<div class="well">
        <h4>Login now</h4>
        <div class="input-group">
            <form action="include/login.php" method="post">
                <label for="useremail" class="form-label">User email</label><br/>

                <input type="email" class="form-control" name="useremail" placeholder="Rameshjha@gmail.com" required="required">

                <label for="userpassword" class="form-label">User password</label><br/>
                <input type="password" class="form-control" name="userpassword" placeholder="password" required="required">
                <br/>
                <br/>

                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="login">
                    LOGIN</button>
                </span>
            </form>
        </div>
        <!-- /.input-group -->
    </div>


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <div class="input-group">
            <form action="search.php" method="post">
                <input type="search" class="form-control" name="search" placeholder="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </form>
        </div>
        <!-- /.input-group -->
    </div>

    <?php
    $query = "select * from catagory";
    $sidebar_category_query = mysqli_query($isconnect, $query);
    ?>


    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    while ($row = mysqli_fetch_assoc($sidebar_category_query)) {
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='search.php?cat_title=$cat_title'>$cat_title </a></li>";
                    } ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php
        include("sideWidgetWell.php")    
    ?>

</div>

</div>
<!-- /.row -->

<hr>