<?php
// include("../../include/db.php");
// $isconnect=mysqli_connect("localhost", "root", "", "cms");
?>


<?php
include("../include/db.php");
?>

<?php
$query_result;

if (isset($_POST["post"])) {

    $post_catagory_id = $_POST['post_catagory_id'];
    $post_author = $_POST['post_author'];
    $post_author = mysqli_real_escape_string($isconnect, $post_author);
    $post_title = $_POST['post_title'];
    $post_title = mysqli_real_escape_string($isconnect, $post_title);
    $post_content = $_POST['post_content'];
    $post_content = mysqli_real_escape_string($isconnect, $post_content);
    $post_tag = $_POST['post_tag'];
    $post_tag = mysqli_real_escape_string($isconnect, $post_tag);

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_status = $_POST['post_status'];
    $post_status = mysqli_real_escape_string($isconnect, $post_status);

    move_uploaded_file($post_image_temp, "../image/$post_image");

    $post_query = "INSERT INTO `posts` (`post_catagory_id`, `post_title`, `post_author`, `post_image`, `post_content`, `post_tag`, `post_status`) VALUES ('$post_catagory_id', '$post_title', '$post_author', '$post_image', '$post_content', '$post_tag ', '$post_status')";

    $query_result = mysqli_query($isconnect, $post_query);
}
?>


<?php
if (isset($_GET['edit'])) {
    $editId = $_GET['edit'];
}
?>
<?php
if (isset($_POST['post'])) {
    if ($query_result) {
        echo "
            <h1 class='page-header'>
            Post Add 
            <small>Sucessfully</small>
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
    Add posts
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
                echo "<option value='$catagory'>$catagory</option>";
            }
            ?>
        </select>
    </div>
    <br />
    <?php
    if (isset($_SESSION['user_name'])) {
        $author_name = $_SESSION['user_name'];
    }
    ?>
    <!-- Redefine author name but author can change his name -->
    <div class="mb-6">
        <label for="post_author" class="form-label">Post Author</label>
        <input type="text" class="form-control" id="post_author" aria-describedby="emailHelp" required="required" name="post_author" value="<?php echo $author_name; ?>">
    </div>
    <br />

    <div class="mb-6">
        <label for="post_title" class="form-label">Post Title</label>
        <input type="text" class="form-control" id="post_title" aria-describedby="emailHelp" required="required" name="post_title">
    </div>
    <br />

    <div class="mb-6">
        <label for="editor" class="form-label">Post Content</label>
        <textarea name="post_content" required="required" class="form-control" id="editor" rows="10"></textarea>
    </div>
    <br />

    <script>
        ClassicEditor.create(document.querySelector("#editor")).catch(error => {
            console.error(error);
        });
    </script>


    <div class="mb-6">
        <label for="post_content" class="form-label">Post Image</label>
        <input type="file" name="post_image">
    </div>
    <br />

    <div class="mb-6">
        <label for="post_status" class="form-label">Post Status</label>
        <input type="text" class="form-control" id="post_status" aria-describedby="emailHelp" required="required" name="post_status">
    </div>
    <br />

    <div class="mb-6">
        <label for="post_tag" class="form-label">Post Tag</label>
        <input type="text" class="form-control" id="post_title" aria-describedby="emailHelp" required="required" name="post_tag" name="post_tag">
    </div>
    <br />

    <div class="form-group">
        <button class="btn btn-primary" name="post">Add post</button>
    </div>
</form>