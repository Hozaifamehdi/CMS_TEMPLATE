<?php
    $comment_query="SELECT * FROM `comment` WHERE `comment_post_id` LIKE '$row_id' AND `comment_status` = 1";

    $comment_result=mysqli_query($isconnect, $comment_query);
    while ($comment_row=mysqli_fetch_assoc($comment_result)) {
        $comment_author=$comment_row['comment_author'];
        $comment_content=$comment_row['comment_content'];
        $comment_date=$comment_row['comment_date'];
        ?>

        <div class="media-body">
        <h4 class="media-heading"><?php echo $comment_author; ?>
        <small><?php echo $comment_date; ?></small>
        </h4>
        <?php echo $comment_content; ?>
        </div> 
        <hr/>
    <?php
    }
?>