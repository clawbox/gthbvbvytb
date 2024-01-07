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
$referby = $res['referred_by'];
$status = $res['status'];
$plan = $res['plan'];
$plan_sql = "SELECT * FROM `plan` WHERE id = '$plan'";
$plan_query = mysqli_query($con,$plan_sql);
$plan2_sql = "SELECT * FROM `plan` ";
$plan_query2 = mysqli_query($con,$plan2_sql);
if($_SERVER["REQUEST_METHOD"] == "POST") {   


    $username_up = $_POST['username'];
    $email_up = $_POST['email'];
    $pubearn = $_POST['pubearn'];
    $referearn = $_POST['referearn'];
    $referby = $_POST['referby'];
    $status_up = $_POST['status'];
    $plan = $_POST['plan'];
    $update_sql = "UPDATE `users` SET`username`='$username_up' ,`plan`='$plan',`email`='$email_up',`publisher_earn`='$pubearn',`referral_earnings`='$referearn',`referred_by`='$referby',`status`='$status_up' WHERE id = '$user_id'";
    $edit_res = mysqli_query($con,$update_sql);

    if($edit_res) {


        $errbox = true;
        $errmsg = "The user has been updated.";

        
        
        $username = $_POST['username'];
        $email =  $_POST['email'];
        $publisher_earnings = $_POST['pubearn'];
        $referral_earnings =  $_POST['referearn'];
        $referby = $_POST['referby'];
        $status = $_POST['status'];





    } else {




        $errbox = true;
        $errmsg = "Something was wrong.";


    }











}


















?>