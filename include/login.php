<?php
include("db.php");
?>
<?php
    session_start();
?>

<?php
if (isset($_POST['login'])) {

    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    $query = "SELECT * FROM `users` WHERE `user_email` = '$useremail' AND `user_password` LIKE '$userpassword'";

    $query_result = mysqli_query($isconnect, $query);

    if (mysqli_fetch_assoc($query_result)) {

        $user_info="SELECT * FROM users where `user_email` = '$useremail'";

        $user_info_result=mysqli_query($isconnect, $user_info);
        $user_row=mysqli_fetch_assoc($user_info_result);
        $user_name=$user_row['user_name'];
        $user_status=$user_row['user_status'];
        $user_email=$user_row['user_email'];
        

        // if statement run if admin didn't blocked this users. 
        if($user_status==1){
            
            $_SESSION['user_name']=$user_name;
            $_SESSION['user_email']=$user_email;
    
            header("location: ../index.php");
        }
        // This statement run if admin blocked this users and it throw message you are blocked. 
        else{
            $_SESSION['user_name']=$user_name;
            $_SESSION['user_status']=0;
            header("location: ../index.php");

        }
    }
    // This statement run if email or password is wrong or even id not reacted dispite it try to login. 
    else {
        $_SESSION['wrong']="wrong";
        header("location: ../index.php");

    }
}
?>