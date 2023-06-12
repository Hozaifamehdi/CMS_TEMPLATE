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

                <h3 class="page-header">
                    All catagories
                </h3>
            </div>
        </div>
        <!-- /.row -->


        <!--This code is used to add catagory into catagory database-->
        <?php
        if (isset($_POST['submit'])) {
            if ($_POST['cat_title'] == " ") {
                echo "<h3><strong>Empty catagory can't added</strong></h3>";
            } else {
                $cat_title = $_POST['cat_title'];

                $search = "select * from  catagory";
                $search_title = mysqli_query($isconnect, $search);
                $count = 0;
                while ($row = mysqli_fetch_assoc($search_title)) {
                    if ($row['cat_title'] == $cat_title) {
                        $count = 1;
                        break;
                    }
                }
                if ($count == 1) {
                    echo "<h3>Duplicate catagory not allowed</h3>";
                } else {
                    $cat_query = "INSERT INTO `catagory` (`cat_title`) VALUES ('$cat_title')";
                    $result = mysqli_query($isconnect, $cat_query);
                }
            }
        }
        ?>





        <!-- This code is used to delete catagory into catagory table -->
        <?php
        if (isset($_GET['delete'])) {

            $cat_id = $_GET['delete'];
            $deleteQuery = "DELETE FROM `catagory` WHERE `catagory`.`cat_id` = $cat_id";
            $result = mysqli_query($isconnect, $deleteQuery);
            header('location:catagories.php');
        }
        ?>



        <!-- To update catagory data base on the basis of cat_id -->
        <?php
            if(isset($_POST['cat_update'])){
                $title=$_POST['update_title'];
                $cat_id=$_GET['cat_id'];
                $Update_Catagories = "UPDATE `catagory` SET `cat_title` = '$title' WHERE `catagory`.`cat_id` = $cat_id";
                $updated_catagories=mysqli_query($isconnect, $Update_Catagories);
                ?>
                <h3> <?php echo $title; ?> updated sucessfully</h3>
                <?php
            }
        ?>



        <!-- for add catagories  -->
        <div class="col-xs-6">
            <form action="catagories.php" method="post">
                <label for="cat_title">Add catagories</label>
                <div class="form-group">
                    <input type="text" name="cat_title" class="form-control" required="required">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" name="submit">Add catagories</button>
                </div>
            </form>
        </div>



        <!-- for edit catagories -->
        <div class="col-xs-6">
            <?php
            if (isset($_GET['update'])) {
                $cat_id=$_GET['update'];
                $cat_title = $_GET['catagory_title'];
                ?>
                <form action="catagories.php?cat_id=<?php echo $cat_id; ?>" method="post">
                    <label for="cat_title">Edit catagories</label>

                    <div class="form-group">
                        <input type="text" name="update_title" class="form-control" required="required"
                            value="<?php echo $cat_title; ?>">
                    </div>
                    <?php
            }
            ?>
                <div class="form-group">
                    <button class="btn btn-primary" name="cat_update">Edit catagories</button>
                </div>
            </form>
        </div>



        <!-- This code of php is used to show catagories in website -->
        <?php
        $query = "select * from catagory";
        $catagory_query = mysqli_query($isconnect, $query);
        ?>

        <div class="col-xs-6">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>catagories title</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>

                <tbody>

                
                    <!-- This code of php is used to print catagories on website -->
                    <?php
                    while ($row = mysqli_fetch_assoc($catagory_query)) {
                        $catagory_id = $row['cat_id'];
                        $catagory_title = $row['cat_title'];
                        echo "<tr>";
                        echo "<th> $catagory_id</th>";
                        echo "<th> $catagory_title</th>";
                        echo "<th><a href='catagories.php?delete=$catagory_id'>delete</a></th>";

                        echo "<th><a href='catagories.php?update=$catagory_id & catagory_title=$catagory_title'>Edit</a></th>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>

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