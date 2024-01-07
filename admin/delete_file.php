<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/user/dashbord/vendor/autoload.php";
use phpseclib3\Net\SFTP;
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";

if(isset($_GET['id'])) {
    $file_id = $_GET['id'];
    $report_id = $_GET['report'];
    $link_data_sql = "SELECT * FROM `files` WHERE  id ='$file_id'";
$link_data_query = mysqli_query($con,$link_data_sql);
$link_data_num = mysqli_num_rows($link_data_query);

if($link_data_num >=1) {
$link_data = mysqli_fetch_array($link_data_query);
$st_serverx = $link_data['server'];

    $drn_name = $link_data['drn_name'];
    if($st_serverx == 1) {
    $file = $_SERVER['DOCUMENT_ROOT']."/uploads/videos/$drn_name"; // path to the video file on the server
   
    if (file_exists($file)) {
        unlink($file);
      
    }
    $delete_sql = "DELETE FROM `files` WHERE id = '$file_id'";
$delete = mysqli_query($con,$delete_sql);
$update_sql = "UPDATE `reports` SET `status`='Solved' WHERE id = '$report_id'";
$update = mysqli_query($con,$update_sql);
header("Location: reports.php");
}else {

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
    $delete_sql = "DELETE FROM `files` WHERE id = '$file_id'";
    $delete = mysqli_query($con,$delete_sql);
    $update_sql = "UPDATE `reports` SET `status`='Solved' WHERE id = '$report_id'";
    $update = mysqli_query($con,$update_sql);
    header("Location: reports.php");
} else {

}

// Close the SFTP connection
$sftp->disconnect();



}

}

}

?>