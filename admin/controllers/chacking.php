<?php

$errmsg = "";
$errbox = false;
$with_id = $_GET['id'];
$chacking_sql = "SELECT * FROM `withdraws` WHERE id = '$with_id'";
$chacking_query = mysqli_query($con,$chacking_sql);
$data = mysqli_fetch_array($chacking_query);
$user_id = $data['user_id'];
$user_sql = "SELECT * FROM `users` WHERE id = '$user_id'";
$user_query = mysqli_query($con,$user_sql);
$user_data = mysqli_fetch_array($user_query);
$username = $user_data['username'];
$stat = $data['status'];
$publisher_earnings = $data['publisher_earnings'];
$referral_earnings = $data['referral_earnings'];
$amount = $data['amount'];
$method = $data['method'];
$account = $data['account'];
$created = $data['created'];
$status = "";

if($stat == "1") {

     $status = "Approved"; 





}
if($stat == "2") {

   $status = "Pending"; 





}

if($stat == "3") {

$status = "Complete"; 





}

if($stat == "4") {

$status = "Cancelled"; 





}

if($stat == "5") {

$status = "Returned"; 





}
// Country Sql
$statistics_sql  = "SELECT country, COUNT(*) FROM statistics WHERE user_id ='$user_id' AND created <= '$created'  GROUP BY country";
$statistics_query = mysqli_query($con,$statistics_sql);

// Ip SQL

$ips_sql = "SELECT ip, COUNT(*) FROM statistics WHERE user_id ='$user_id' AND created <= '$created'  GROUP BY ip";
$ips_query = mysqli_query($con,$ips_sql);


// Refer Domain 

$refer_sql = "SELECT referer_domain, COUNT(*) FROM statistics WHERE user_id ='$user_id' AND created <= '$created'  GROUP BY referer_domain";
$refer_query = mysqli_query($con,$refer_sql);




$withdraws_sql = "SELECT * FROM `withdraws` WHERE id = '$with_id' ";
$query = mysqli_query($con,$withdraws_sql);
$resss = mysqli_fetch_array($query);

// Approve Funtion 
if(isset($_POST['appid'])){

   $userid = $_POST['userid'];
    $withid = $_POST['appid'];
    $approve_sql = "UPDATE `withdraws` SET `status`='1' WHERE user_id = '$userid' AND id = '$withid' ";   
    $approve_query = mysqli_query($con,$approve_sql);
    if($approve_query) {
      $errbox = true;
       $errmsg = "Withdraws was Successful Approved.";
       $stat = "1";
       $status = "Approved"; 


    } else {
      $errbox = true;
       $errmsg = "Something was wrong.";
    }   
   }

   // Cancelled Funtion

   if(isset($_POST['cancelid']))  {
           $cancelid = $_POST['cancelid'];
           $userid =  $_POST['userid'];
           $can_sql = "UPDATE `withdraws` SET `status`='4' WHERE id = '$cancelid' AND user_id = '$userid' ";
           $can_query = mysqli_query($con,$can_sql);

           if($can_query) {
              
       $errbox = true;
       $errmsg = "Withdraws was Successful Cancelled.";
       $stat = "4";
       $status = "Cancelled"; 
      
           }  else {
            $errbox = true;
             $errmsg = "Something was wrong.";
          }  
      
   }

   // Complete Funtion

   if(isset($_POST['campleteid']))  {

      $campleteid = $_POST['campleteid'];
      $userid =  $_POST['userid'];
      $cam_sql = "UPDATE `withdraws` SET `status`='3' WHERE id = '$campleteid' AND user_id = '$userid' ";
      $cam_query = mysqli_query($con,$cam_sql);
      if($cam_query) {

         $errbox = true;
         $errmsg = "Withdraws was Successful Completed.";
         $stat = "3";
       $status = "Completed"; 
         
      } else {
         $errbox = true;
          $errmsg = "Something was wrong.";
       }  

   }




?>