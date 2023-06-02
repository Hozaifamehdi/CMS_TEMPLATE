<?php

$isconnect= mysqli_connect("localhost", "root", "", "cms");
$comment_post_catagory=2;
$comment_post_query = "select * from posts where post_id='$comment_post_catagory'";
$comment_post_result = mysqli_query($isconnect, $comment_post_query);
$comment_post_row = mysqli_fetch_assoc($comment_post_result);
$post_title = $comment_post_row['post_title'];
echo "$post_title";
?>