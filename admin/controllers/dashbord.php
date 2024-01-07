<?php

include $_SERVER['DOCUMENT_ROOT']."/user/dashbord/vendor/autoload.php";
use phpseclib3\Net\SFTP;
$total_user_sql = "SELECT * FROM `users`";
$total_user_query = mysqli_query($con,$total_user_sql);
$total_user = mysqli_num_rows($total_user_query);

$date= date("Y-m-d") ;
$from = $date. " 00:00:00";
$to = $date. " 23:59:59";
$month = date("Y-m-t", strtotime($date));
$thismonth =  $month. " 23:59:59" ;
$from_date_month = date("Y-m") ;
$from_month =  $from_date_month . "-1 23:59:59" ;
$monthly_report = "SELECT * FROM  statistics WHERE created >= '$from_month' AND created <= '$thismonth' ";
$monthly_data =mysqli_query($con,$monthly_report);
$monthly_get_data =mysqli_num_rows($monthly_data);
$totsl_earning_monthly = mysqli_query($con, "SELECT SUM(publisher_earn) AS publisher_earn_sum FROM statistics WHERE created >= '$from_month' AND created <= '$thismonth' ");
$monthly_totsl_earning =mysqli_fetch_array($totsl_earning_monthly);
$monthly_rate = "0.0000";
if($monthly_totsl_earning['publisher_earn_sum'] >0) {

$monthly_rate = $monthly_totsl_earning['publisher_earn_sum'];
}

$refer_totsl_earning_monthly = mysqli_query($con, "SELECT SUM(referral_earn) AS referral_earn_sum FROM statistics WHERE created >= '$from_month' AND created <= '$thismonth' ");
$refer_monthly_totsl_earning =mysqli_fetch_array($refer_totsl_earning_monthly);
$refer_monthly_rate = "0.0000";
if($refer_monthly_totsl_earning['referral_earn_sum'] >0) {

$refer_monthly_rate = $refer_monthly_totsl_earning['referral_earn_sum'];
}

		
if(isset($_GET['type']) && $_GET['type']=='delete'){

   $link_a = $_GET['id'];
 
$link_data_sql = "SELECT * FROM `files` WHERE  id ='$link_a'";
$link_data_query = mysqli_query($con,$link_data_sql);
$link_data_num = mysqli_num_rows($link_data_query);

if($link_data_num >=1) {
$link_data = mysqli_fetch_array($link_data_query);

$st_serverx = $link_data['server'];
if($st_serverx == 1) {
    $drn_name = $link_data['drn_name'];
    $file = $_SERVER['DOCUMENT_ROOT']."/uploads/videos/$drn_name"; // path to the video file on the server
   
    if (file_exists($file)) {
        unlink($file);
      
    }
    $update_sql = "DELETE FROM `files` WHERE id = '$link_a'";
    $update_run = mysqli_query($con,$update_sql);
}else {

    $drn_name = $link_data['drn_name'];
    // Server details
    $server_data_sql = "SELECT * FROM `server` WHERE id = '$st_serverx'";
    $server_data_query = mysqli_query($con,$server_data_sql);
    $server_data = mysqli_fetch_assoc($server_data_query);
    $host = $server_data['hostname'];
    $username = $server_data['username'];
    $password = $server_data['password'];

// Remote file path to delete
$remoteFilePath = $server_data['path'].$drn_name;

// Initialize SFTP object
$sftp = new SFTP($host);

// Connect to the SFTP server
if (!$sftp->login($username, $password)) {
    exit('Login Failed');
}

// Delete the file
if ($sftp->delete($remoteFilePath)) {
    $update_sql = "DELETE FROM `files` WHERE id = '$link_a'";
    $update_run = mysqli_query($con,$update_sql);
} else {
   
}

// Close the SFTP connection
$sftp->disconnect();
}
   
   




}
 }
 
 






















?>