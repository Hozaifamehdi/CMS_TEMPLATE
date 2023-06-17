<?php
include("db.php");
?>
<?php
    session_start();
?>

<?php
if (isset($_POST['login'])) {

    $useremail = $_POST['useremail'];
    $useremail = mysqli_real_escape_string($isconnect, $useremail);
    $userpassword = $_POST['userpassword'];
    $userpassword = mysqli_real_escape_string($isconnect, $userpassword);


    $query = "SELECT * FROM `users` WHERE `user_email` = '$useremail'";

    $query_result = mysqli_query($isconnect, $query);


    $query_mail = mysqli_fetch_assoc($query_result);
    $database_password = $query_mail['user_password'];

    $encrypt_password = password_verify($userpassword, $database_password);
    // echo $encrypt_password;

    if($encrypt_password){
        // if (mysqli_fetch_assoc($query_result)) {

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

                $online_query= "UPDATE `users` SET `users_online` = '1' WHERE `users`.`user_email` = '$user_email'";
                $result_online_query = mysqli_query($isconnect, $online_query);

                if(!$result_online_query){
                    die("Error!  ". mysqli_error($isconnect));
                }else{
                    header("location: ../index.php");
                }
            }
            // This statement run if admin blocked this users and it throw message you are blocked. 
            else{
                $_SESSION['user_name']=$user_name;
                $_SESSION['user_status']=0;
                header("location: ../index.php");

            // }
        // }else{
        //     echo "problem";
        // }
    }
    // This statement run if email or password is wrong or even id not reacted dispite it try to login. 
}
else{
    $_SESSION['wrong']="wrong";
    header("location: ../index.php");

}
}
?>