<?php
    // include("../include/db.php");

    $isconnect=mysqli_connect("localhost", "root", "", "cms");
?>

<?php
    // if(isset($_GET['edit'])){
    //     $edit=$_GET['edit'];

        
    //     include("add_posts.php");
    // }

    if(isset($_GET['delete'])){
        $del=$_GET['delete'];

        $delete_query="DELETE FROM `posts` WHERE `posts`.`post_id` = $del";

        $delete_result=mysqli_query($isconnect, $delete_query);

        if($delete_result){
            echo "<h2>Posts delete sucessfully</h2>";
        }else{
            echo "<h2>Error! </h2><h3>try again</h3> ";
        }
    }
?>

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
                    <a href="include/gets_all_posts.php?edit=<?php echo $Id;?>">Edit</a>
                </td>
                <td>
                    <a href="include/gets_all_posts.php?delete=<?php echo $Id;?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>