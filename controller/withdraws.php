<?php


$withmsg = "";
$withmsg2 = "";
$errore = false;
$successs = false;
$pending_sql = "SELECT SUM(amount) AS amount_pending FROM withdraws WHERE user_id='$user_id' AND status='2'";
$pending_query = mysqli_query($con,$pending_sql);
$pending_res = mysqli_fetch_array($pending_query);
if($pending_res['amount_pending'] >0) {
         
    $pending = $pending_res['amount_pending'];
}
else{

    $pending = "0.000";
}

// Total Withdraws 

$total_sql = "SELECT SUM(amount) AS amount_total FROM withdraws WHERE user_id='$user_id' AND status='3'";
$total_query = mysqli_query($con,$total_sql);
$total_res = mysqli_fetch_array($total_query);
if($total_res['amount_total'] >0) {
         
    $total = $total_res['amount_total'];
}
else{

    $total = "0.000";
}


// Withdraws History

$history_sql = "SELECT * FROM `withdraws` WHERE user_id='$user_id'";
$history_query = mysqli_query($con,$history_sql);



if(isset($_POST['publisher_earnings'])){


$publisher_earn = $publisher_earnings;
$referral_earn = $referral_earnings;
$balance_earn = $Balance;
$status_with = 2;

if(empty($withdrawal_method))  {
    
    $errore = true;
$withmsg = " You should fill your withdrawal info from your profile settings.";


}elseif(empty($withdrawal_account)) {
if($withdrawal_method == "bank") {

if(empty($bank_name)) {

    $errore = true;
$withmsg = " You should fill your withdrawal info from your profile settings.";




}else {

    $sql_withdo = "Select * from withdraw_methods where name = '$withdrawal_method'";
    $with_query = mysqli_query($con,$sql_withdo);
    $sql_with = mysqli_fetch_array($with_query);
    $min_with = $sql_with['amount'];
    
    if($min_with <= $balance_earn) {
    
    
    $withd_update_sql = "UPDATE `users` SET `publisher_earn`=`publisher_earn`-$publisher_earn,`referral_earnings`= referral_earnings-$referral_earn WHERE id ='$user_id'";
    $res_with = mysqli_query($con,$withd_update_sql);
    if($res_with) {
    
        $withd_sql = " INSERT INTO `withdraws` (`user_id`, `status`, `publisher_earnings`, `referral_earnings`, `amount`, `method`, `account`, `created`) VALUES ( '$user_id', '$status_with', '$publisher_earn', '$referral_earn', '$balance_earn', '$withdrawal_method', '$withdrawal_account', current_timestamp())";
        $withd_query = mysqli_query($con,$withd_sql);
        $successs = true;
        $withmsg2 = "Your Withdraw Request has been Successfully Placed";
    
     $Balance = "0";
     $pending =$pending_res['amount_pending']+ $balance_earn;
        
    
    } else {
    
        $errore = true;
    $withmsg = "Something Wrong";
    
    }
     
    } else {
        $errore = true;
        $withmsg = "Withdraw amount should be equal or greater than $$min_with";
    }
    

}

}else {

    $errore = true;
$withmsg = " You should fill your withdrawal info from your profile settings.";


}


} else{
$sql_withdo = "Select * from withdraw_methods where name = '$withdrawal_method'";
$with_query = mysqli_query($con,$sql_withdo);
$sql_with = mysqli_fetch_array($with_query);
$min_with = $sql_with['amount'];

if($min_with <= $balance_earn) {


$withd_update_sql = "UPDATE `users` SET `publisher_earn`=`publisher_earn`-$publisher_earn,`referral_earnings`= referral_earnings-$referral_earn WHERE id ='$user_id'";
$res_with = mysqli_query($con,$withd_update_sql);
if($res_with) {

    $withd_sql = " INSERT INTO `withdraws` (`user_id`, `status`, `publisher_earnings`, `referral_earnings`, `amount`, `method`, `account`, `created`) VALUES ( '$user_id', '$status_with', '$publisher_earn', '$referral_earn', '$balance_earn', '$withdrawal_method', '$withdrawal_account', current_timestamp())";
    $withd_query = mysqli_query($con,$withd_sql);
    $successs = true;
    $withmsg2 = "Your Withdraw Request has been Successfully Placed";

 $Balance = "0";
 $pending =$pending_res['amount_pending']+ $balance_earn;
    

} else {

    $errore = true;
$withmsg = "Something Wrong";

}
 
} else {
    $errore = true;
    $withmsg = "Withdraw amount should be equal or greater than $$min_with";
}

}








}








































