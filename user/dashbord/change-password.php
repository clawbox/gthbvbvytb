<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";

$pi = "Change Password";
$act = "acc";
$errore = false;

if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }
if(isset($_POST['current_password'])) {

$current_password = $_POST['current_password'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$chng_sql = "SELECT * FROM `users` WHERE id ='$user_id'";
$chan_query = mysqli_query($con,$chng_sql);
while($res_change_pass = mysqli_fetch_assoc($chan_query)) {

    if(password_verify($current_password,$res_change_pass['password'])) {

    
if($password == $confirm_password) {
    $has_new  = password_hash($confirm_password,PASSWORD_DEFAULT);
    $update_pass_sql = "UPDATE `users` SET `password`='$has_new' WHERE id='$user_id'";
    $update_pass_query = mysqli_query($con,$update_pass_sql);
    if($update_pass_query) {
      
   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;

    }
else {
    $errore = true;
    $msgproblem = "Something was Wrong.";

}

    
    
    }
    else {
          
        $errore = true;
        $msgproblem = "Oops! New Password And Re-enter New Password are Not the same . Please make the correction.";
        
            }
     
    }

    else {
        $errore = true;
$msgproblem = "Oops! There are mistakes in Current Password. Please make the correction.";

    }
 
}


}

include 'header.php';
?>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
         

          <div class="section-body">
           
            <div class="card">
            <div class="card-body">
            <h5 >Change your Password</h5>
             <br> 
           
    <?php  if($errore) { ?>
<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle"></i> <?php echo $msgproblem; ?></div>
<?php } ?>


<form method="post" accept-charset="utf-8" >
<input type="password" name="current_password" placeholder="Current Password" class="form-control input-default"    required  > 
<br>
<input type="password" name="password" class="form-control input-default" placeholder="New Password" required="required" id="password">
<br>
<input type="password" name="confirm_password" class="form-control input-default" placeholder="Re-enter New Password">
<br>
<button class="btn mb-1 btn-rounded btn-primary" type="submit">Change Password</button>
</form> 


</div>
              
              </div>
            </div>
          </section>
        </div>

<?php
include 'footer.php';

?>
