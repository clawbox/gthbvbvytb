<?php
$msg = "";
$invaild = false;

if($_SERVER["REQUEST_METHOD"] == "POST") {  

$email = $_POST['email'];

$sql = "SELECT * FROM `users` WHERE email ='$email'";

$query = mysqli_query($con,$sql);
$num = mysqli_num_rows($query);

$namesql = "Select * from settings where id = 1 ";
$dataquery = mysqli_query($con,$namesql) ;
$namedata = mysqli_fetch_array($dataquery);
$name = $namedata['value'];
$token = bin2hex(random_bytes(15));

if($num == "1") {
    $res = mysqli_fetch_assoc($query);
$username = $res['username'];
$err = true;
$up_sql = "UPDATE `users` SET `token`='$token' WHERE email ='$email'";
$up_res = mysqli_query($con,$up_sql);
$to_email = $email;
$subject = "Password Reset";
$body = "Hello $username,

Someone requested that the password to be reset If this was a mistake, just ignore this email and nothing will happen.

To reset your password click on the following link or copy-paste it in your browser:

https://$main_domain/recover_account.php?token=$token


";
$headers = "From: no_reply@$main_domain";

mail($to_email, $subject, $body, $headers);
$msg = "Check Your Email";
} else {
 $invaild = true;
 $msg = "No Account Found.";

    
}



}











