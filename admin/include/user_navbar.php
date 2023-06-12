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
            <a class="navbar-brand" href="../index.php">Back</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">

            <li><a href="../index.php">Home</a></li>

            <li>
                <a href=""><i class="fa fa-user"></i> <?php echo $user_name; ?> <b
                        class="caret"></b></a>
            </li>

            <li>
                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>

        </ul>



        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    </nav>