<?php
include 'config/config.php';
include $_SERVER['DOCUMENT_ROOT']."/user/dashbord/vendor/autoload.php";
use phpseclib3\Net\SFTP;
$days_sql = "SELECT * FROM `settings` WHERE id = '14'";
$days_query = mysqli_query($con,$days_sql);
$days_data = mysqli_fetch_assoc($days_query);
$days = $days_data['value'];
$cutOffDate = date('Y-m-d', strtotime('-'.$days.' days'));
$cutOffDate = "$cutOffDate 00:00:00";
$sql = "SELECT * FROM `files` WHERE `created` <= '$cutOffDate'";
$query = mysqli_query($con,$sql);
while($data = mysqli_fetch_assoc($query)) {
$file = $data['id'];

$check_sql = "SELECT * FROM `statistics` WHERE `link_id` = '$file' AND `created` >= '$cutOffDate'";
$check_query = mysqli_query($con,$check_sql);
$check_num = mysqli_num_rows($check_query);
if($check_num == 0) {
$st_serverx = $data['server'];

$file_namme = $data['drn_name'];
    if($st_serverx == 1) {
$fileToDelete = "uploads/videos/$file_namme";
if (file_exists($fileToDelete)) {
  if (unlink($fileToDelete)) {
      echo "File deleted successfully.";
      $file_del_sql = "DELETE FROM `files` WHERE id = '$file'";
      $file_del = mysqli_query($con,$file_del_sql);
  } else {
      echo "Unable to delete the file.";
  }
} else {
  echo "File does not exist.";
}

}else {
    
    
    
     $server_data_sql = "SELECT * FROM `server` WHERE id = '$st_serverx'";
 $server_data_query = mysqli_query($con,$server_data_sql);
 $server_data = mysqli_fetch_assoc($server_data_query);
 $host = $server_data['hostname'];
 $username = $server_data['username'];
 $password = $server_data['password'];

// Remote file path to delete
$remoteFilePath = $server_data['path'].$file_namme;

// Initialize SFTP object
$sftp = new SFTP($host);

// Connect to the SFTP server
if (!$sftp->login($username, $password)) {
 exit('Login Failed');
}

// Delete the file
if ($sftp->delete($remoteFilePath)) {
    echo "File deleted successfully.";
      $file_del_sql = "DELETE FROM `files` WHERE id = '$file'";
      $file_del = mysqli_query($con,$file_del_sql);
} else {

}

// Close the SFTP connection
$sftp->disconnect();
}
}else {
    
    
    echo $sql;
    echo "<br>";
    echo $check_sql;
}

}

    



?>