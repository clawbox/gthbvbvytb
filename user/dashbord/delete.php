<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";

$pi = "Dashbord";
$act = "dashbord";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }

if(isset($_GET['id'])) {

$link_a = $_GET['id'];
$link_data_sql = "SELECT * FROM `files` WHERE user_id = '$user_id' AND alies ='$link_a'";
$link_data_query = mysqli_query($con,$link_data_sql);
$link_data_num = mysqli_num_rows($link_data_query);
if($link_data_num == 1) {
$link_data = mysqli_fetch_array($link_data_query);
$user_file = $link_data['user_id'];
if($user_file == $user_id) {
    $drn_name = $link_data['drn_name'];
    $file = $_SERVER['DOCUMENT_ROOT']."/uploads/videos/$drn_name"; // path to the video file on the server
   
    if (file_exists($file)) {
        unlink($file);
      
    }
   
    $update_sql = "DELETE FROM `files` WHERE alies = '$link_a'";
    $update_run = mysqli_query($con,$update_sql);
    header("Location: videos.php");
    


}
}
}