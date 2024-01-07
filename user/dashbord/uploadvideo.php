<?php
session_start();
require_once 'vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";
$file_name =  $_FILES['file']['name'];
use phpseclib3\Net\SFTP;
$server_data_sql = "SELECT * FROM `server` WHERE id = '$st_server'";
$server_data_query = mysqli_query($con,$server_data_sql);
$server_data = mysqli_fetch_assoc($server_data_query);
$host = $server_data['hostname'];
$username = $server_data['username'];
$password = $server_data['password'];

$short_sql = "Select * from settings where id = 19";
$short_query = mysqli_query($con,$short_sql);
$short_data = mysqli_fetch_array($short_query);
$short = $short_data['value'];
$remoteDirectory = $server_data['path'];
$remoteFilename = time().basename($_FILES['file']['name']);
$remoteFilePath = $remoteDirectory . $remoteFilename;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize the SFTP object
$sftp = new SFTP($host);

// Connect to the FTP server
if (!$sftp->login($username, $password)) {
    exit('Login Failed');
}

// Move the uploaded file to the remote directory
if (!$sftp->put($remoteFilePath, $_FILES['file']['tmp_name'], SFTP::SOURCE_LOCAL_FILE)) {
    exit('File Upload Failed');
}
 function random_strings($length_of_string)
                {
                  
                    // String of all alphanumeric character
                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                  
                    // Shuffle the $str_result and returns substring
                    // of specified length
                    return substr(str_shuffle($str_result), 
                                       0, $length_of_string);
                }
                
                $ramdalias = random_strings(5);
    
            $sql = "INSERT INTO `files`( `user_id`, `file_name`, `drn_name`, `alies`, `status`, `server`) VALUES ('$user_id','$file_name','$remoteFilename','$ramdalias','active','$st_server')";
       $run = mysqli_query($con,$sql);
if(empty($short)) {  } else { $main_domain =  $short;  } 
// Generate the file URL
$fileUrl = 'https://'.$main_domain.'/' . $ramdalias;

// Return the file URL as JSON response
$response = ['fileUrl' => $fileUrl];
header('Content-Type: application/json');
echo json_encode($response);
?>
