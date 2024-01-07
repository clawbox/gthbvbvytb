<?php


 $errmsg = "";
 $errbox = false;
$user_id = $_GET['id'];
$sql = "SELECT * FROM `users` WHERE id = '$user_id'";
$query = mysqli_query($con,$sql);
$res = mysqli_fetch_array($query);
$username = $res['username'];
$email = $res['email'];
$publisher_earnings = $res['publisher_earn'];
$referral_earnings = $res['referral_earnings'];

$withdrawal_method = $res['method'];
$withdrawal_account = $res['account'];

$status = $res['status'];
$joined = $res['joined'];
$plan = $res['plan'];
$plan_sql = "SELECT * FROM `plan` WHERE id = '$plan'";
$plan_query = mysqli_query($con,$plan_sql);
$plan_data = mysqli_fetch_array($plan_query);
$plan_name = $plan_data['name'];
if(isset($_GET["ban"]))
{ 




$fly_sql = "UPDATE `users` SET `status`='inactive' WHERE id = '$user_id'";
$fly_res = mysqli_query($con,$fly_sql);

if($fly_res) {

$errbox = true;
$errmsg = "User has beem successful Ban";



}else {
    $errbox = true;
    $errmsg = "Something was wrong";



}
















}


















?>