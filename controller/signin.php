<?php
$msg = "";
error_reporting(0); 

if(isset($_POST['username'])) {
$username = $_POST["username"];
$password = $_POST["password"];
$sql = "Select * from users where username='$username' AND status ='active' ";
$result = mysqli_query($con,$sql);
$num = mysqli_num_rows($result);

if($num == 1){
 while($row=mysqli_fetch_assoc($result)){
if(password_verify($password,$row['password'])) {
   session_start();
   $_SESSION['loggedin'] = true;
   $_SESSION['username'] = $username;
   header("location:/user/dashbord");
die();

}
else {

 $msg = "Password Wrong";
}

 }
   

}


else {

   $msg = "Username not found";
}
}


?>