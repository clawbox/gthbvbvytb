<?php


   $status = "";
$errmsg = "";
$errbox = false;
$start = 0;
$per_page = 10;
$current_page = 1;
if(isset($_GET['page'])) {


$start = $_GET['page'];
$current_page = $start;
$start --;
$start = $start*$per_page;



}
$withdraws_sql = "SELECT * FROM `withdraws` ORDER BY id DESC limit $start,$per_page ";
$query = mysqli_query($con,$withdraws_sql);

// Approve Funtion 
if(isset($_POST['appid'])){

   $userid = $_POST['userid'];
    $withid = $_POST['appid'];
    $approve_sql = "UPDATE `withdraws` SET `status`='1' WHERE user_id = '$userid' AND id = '$withid' ORDER BY id DESC ";   
    $approve_query = mysqli_query($con,$approve_sql);
    if($approve_query) {
      $errbox = true;
       $errmsg = "Withdraws was Successful Approved.";

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
         
      } else {
         $errbox = true;
          $errmsg = "Something was wrong.";
       }  

   }

   
























?>