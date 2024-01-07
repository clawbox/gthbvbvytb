<?php
$successs = false;
$msg = "";
$erro = false;
if(isset($_POST['withdrawal_method'])){


    $withdrawal_method_update = $_POST['withdrawal_method'];
    $withdrawal_account_update = $_POST['withdrawal_account'];

    
  


    $profile_update_sql = "UPDATE `users` SET `method`='$withdrawal_method_update',`account`='$withdrawal_account_update' WHERE id='$user_id'";
    $profile_update_res = mysqli_query($con,$profile_update_sql);
   
    if($profile_update_res) {
        $successs = true;
        $msg = "Profile Updated";
    $withdrawal_method = $_POST['withdrawal_method'];
    $method_res = $withdrawal_method_update;
    $withdrawal_account = $withdrawal_account_update;
    }


}

   
