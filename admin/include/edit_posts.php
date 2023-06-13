<?php
include("../include/db.php");
?>


<?php
$editId;


$my_catagories;
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];

    $query = "SELECT * FROM `posts` WHERE post_id='$editId'";

    $edit_result = mysqli_query($isconnect, $query);

    $row = mysqli_fetch_assoc($edit_result);

    $post_catagory_id = $row['post_catagory_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_content = $row['post_content'];
    $post_tag = $row['post_tag'];

    $post_image = $row['post_image'];

    $post_status = $row['post_status'];
    $my_catagories = $post_catagory_id;
}
?>

<?php
// $query_result;

if (isset($_POST["edit_post"])) {

    $query_result;
    // $post_id=$POST["edit_post"];
    $post_catagory_id = $_POST['post_catagory_id'];
    $post_author = $_POST['post_author'];
    $post_title = $_POST['post_title'];
    $post_content = $_POST['post_content'];
    $post_content= mysqli_real_escape_string($isconnect, $post_content);
    $post_tag = $_POST['post_tag'];
    $post_tag = mysqli_real_escape_string($isconnect, $post_tag);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_status = $_POST['post_status'];


    if (!$post_image) {
        $image_query = "select * from posts where post_id=$editId";

        $image_query = mysqli_query($isconnect, $image_query);

        $row = mysqli_fetch_assoc($image_query);
        $post_image = $row['post_image'];
    }
    move_uploaded_file($post_image_temp, "../image/$post_image");

    $post_query = "UPDATE `posts` SET `post_catagory_id` = '$post_catagory_id', `post_author` = '$post_author', `post_title`='$post_title', `post_content` = '$post_content', `post_tag`= '$post_tag', `post_image`= '$post_image', `post_status` = '$post_status' WHERE `posts`.`post_id` = '$editId'";


    $query_result = mysqli_query($isconnect, $post_query);
}
?>

<?php

if (isset($_POST['edit_post'])) {
    if ($query_result) {
        echo "
            <h1 class='page-header'>
            Post Updated
            <small>Sucessfully  <a href='../search.php?update_my_post=$editId'>View post</a></small>
            </h1>";

    } else {
        echo "
            <h2 class='page-header'>
            Data not post sucessfully</h2> 
            <small>Try again!</small>";
    }
}
?>
<h3 class="page-header">
    Update post
</h3>


<form action="#" method="post" enctype="multipart/form-data">
    <div class="mb-6">
        <label for="post_catagory_id" class="form-label">Post Catagory</label>
        <?php
        $cat_query = "select * from catagory";

        $result = mysqli_query($isconnect, $cat_query);
        ?>
        <br />

        <select name="post_catagory_id" id="" class="form-control">

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                    $catagory = $row['cat_title'];
                ?>
                <option value='<?php echo $catagory; ?>' <?php if ($my_catagories == $catagory) {
                       echo 'selected=selected';
                   } ?>      >     <?php echo $catagory; ?> </option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-6">
        <label for="post_author" class="form-label">Post Author</label>
        <input type="text" class="form-control" id="post_author" aria-describedby="emailHelp" required="required"
            name="post_author" value="<?php echo $post_author; ?>">
    </div>

    <div class="mb-6">
        <label for="post_title" class="form-label">Post Title</label>
        <input type="text" class="form-control" id="post_title" aria-describedby="emailHelp" required="required"
            name="post_title" value="<?php echo $post_title; ?>">
    </div>

    <div class="mb-6">
        <label for="your_summernote" class="form-label">Post Content</label>
        <textarea name="post_content" required="required" class="form-control" id="your_summernote" rows="5"><?php echo $post_content; ?></textarea>
    </div>

    <br />

    <div><img src="../image/<?php echo $post_image; ?>" width="200px"></div>

    <div class="mb-6">
        <label for="post_image" class="form-label">Post Image</label>
        <input type="file" name="post_image" value="../image/<?php echo $post_image; ?>">
    </div>

    <br />
    <div class="mb-6">
        <label for="post_status" class="form-label">Post Status</label>
        <input type="text" class="form-control" id="post_status" aria-describedby="emailHelp" required="required"
            name="post_status" value="<?php echo $post_status; ?>">
    </div>

    <div class="mb-6">
        <label for="post_tag" class="form-label">Post Tag</label>
        <input type="text" class="form-control" id="post_title" aria-describedby="emailHelp" required="required"
            name="post_tag" name="post_tag" value="<?php echo $post_tag; ?>">
    </div>
    <br />

    <div class="form-group">
        <button class="btn btn-primary" name="edit_post">Update post</button>
    </div>
</form>