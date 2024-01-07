<?php
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$name_sql = "SELECT * FROM `settings` WHERE id = '1'";
$name_query = mysqli_query($con,$name_sql);
$name_data = mysqli_fetch_assoc($name_query);
$name = $name_data['value'];
$main_domain_sql = "SELECT * FROM `settings` WHERE id = '3'";
$main_domain_query = mysqli_query($con,$main_domain_sql);
$main_domain_data = mysqli_fetch_assoc($main_domain_query);
$main_domain = $main_domain_data['value'];
function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
if(isset($_GET['id'])) {
$l = $_GET['id'];
if (isset($_SERVER['HTTP_REFERER'])) {
    $refers = $_SERVER['HTTP_REFERER'];
} else {
    $refers = ''; // Set a default value or handle the absence of the referrer URL as needed.
}
if(!empty($refers)) {
$do = parse_url($refers);

$refer = $do['host'];
}else {


    $refer = "";
}
if($refer == $main_domain) {

$res=mysqli_query($con,"select *  from files where alies='$l' and status='active'");
	

$row=mysqli_fetch_assoc($res);
$file_name=$row['file_name'];
$drn_name=$row['drn_name'];
$drn_name2=$row['drn_name'];
$user_id = $row['user_id'];
$video_id = $row['id'];   
$st_server = $row['server'];

if($st_server == 1) {
    $drn_name = "https://$main_domain/$drn_name";
    $encodedUrl = str_replace(' ', '%20', $drn_name);
    
          $customFileName = $file_name;
  

          // Get the contents of the remote file
          $videoUrl = $encodedUrl;

          
          // Set appropriate headers for file download
          header('Content-Description: File Transfer');
          header('Content-Type: application/octet-stream');
          header('Content-Disposition: attachment; filename="' . $customFileName . '"');
        
          // Download the video file
          readfile($videoUrl);
          
          exit;
        
        
       
}else {

    $server_data_sql = "SELECT * FROM `server` WHERE id = '$st_server'";
$server_data_query = mysqli_query($con,$server_data_sql);
$server_data = mysqli_fetch_assoc($server_data_query);
$host = $server_data['hostname'];
$drn_name = "https://$host/$drn_name";
$encodedUrl = str_replace(' ', '%20', $drn_name);

      $customFileName = $file_name;

      // Get the contents of the remote file
      $videoUrl = $encodedUrl;
      
      
      // Set appropriate headers for file download
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="' . $customFileName . '"');
      
      // Download the video file
      readfile($videoUrl);
      
      exit;
    
    
}

    
    
	} else {

        echo $refer;
        die();
    }
}
