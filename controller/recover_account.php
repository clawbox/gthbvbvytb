<?php
$msg = "";
$invaild = false;

if(isset($_POST['pass'])) {
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
if($pass  == $pass2) {

   
    $hash = password_hash($pass,PASSWORD_DEFAULT);
    $up_sql = "UPDATE `users` SET `password`='$hash'  WHERE token ='$toekn'";
    $res = mysqli_query($con,$up_sql);
    $up_sql = "UPDATE `users` SET `token`=''  WHERE token ='$toekn'";
    $res = mysqli_query($con,$up_sql);
    
$msg = "Your Password has been Updated successfully";

}else {

$invaild = true;


}


}







