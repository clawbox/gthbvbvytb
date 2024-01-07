<?php
$msg = "";
if(isset($_POST['username'])) {
$username = $_POST['username'];
$password = $_POST['password'];
$password_compare = $_POST['password_compare'];
$email = $_POST['email'];
$refer = $_POST['refer'];
$check_username_sql = "SELECT * FROM `users` WHERE username = '$username'";
$check_username_query = mysqli_query($con,$check_username_sql);
$check_username = mysqli_num_rows($check_username_query);
if($check_username == 1) {

    $msg = "Username is already exist";


} else {
    $check_email_sql = "SELECT * FROM `users` WHERE email = '$email'";
    $check_email_query = mysqli_query($con,$check_email_sql);
    $check_email = mysqli_num_rows($check_email_query);

    if($check_email == 1)  {


$msg = "Email is already exist";


    }else {

if($password == $password_compare) {
    $hash = password_hash($password,PASSWORD_DEFAULT);
       $api = rand(1000000000000,9990000000000);
   function random_strings($length_of_string) {
	
     
      return substr(md5(time()), 0, $length_of_string);
   }

   $key = random_strings(32);
$register_sql = "INSERT INTO `users`(`username`, `email`, `password`, `publisher_earn`, `referral_earnings`, `method`, `account`, `api_key`, `referred_by`, `status`, `token`) VALUES ('$username','$email','$hash','0','0','','','$key','$refer','active','')";
$register_user = mysqli_query($con,$register_sql);

header("Location: signin.php");


}else {


    $msg = "Password and Confirm Password are not same ";




}





    }



}


}





?>