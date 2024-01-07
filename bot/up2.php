<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
$file_name =  $_FILES['video']['name'];
$tmp_name = $_FILES['video']['tmp_name'];
$user_id = $_POST['userId'];
$chack_sql = "SELECT * FROM bot WHERE chat_id = '$user_id'";
    $chack_query = mysqli_query($con,$chack_sql);
    $chack_data = mysqli_fetch_assoc($chack_query);
    $api = $chack_data['api'];
    $regex_pattern = "/^\/api\s+([a-zA-Z0-9]+)$/"; // regex pattern to match the URL path and extract the alphanumeric string

if (preg_match($regex_pattern, $api, $matches)) {
    $api_key = $matches[1]; // extract the API key from the matched regex pattern
   
}
$user_id_sql = "SELECT * FROM `users` WHERE `api_key` = '$api_key'";
$user_id_query = mysqli_query($con,$user_id_sql);
$user_data = mysqli_fetch_assoc($user_id_query);
$userid = $user_data['id'];
$allowed_types = array('video/mp4', 'video/mpeg', 'video/avi', 'video/mkv');
if (in_array($_FILES['video']['type'], $allowed_types)) {
    $max_size = 419430400; 
    if ($_FILES['video']['size'] <= $max_size) {
        $file_up_name = time().$file_name;
        move_uploaded_file($tmp_name, $_SERVER['DOCUMENT_ROOT'] ."/uploads/videos/".$file_up_name);
       
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
    
            $sql = "INSERT INTO `files`( `user_id`, `file_name`, `drn_name`, `alies`, `status`) VALUES ('$userid','$file_up_name','$file_up_name','$ramdalias','active')";
       $run = mysqli_query($con,$sql);

       echo "https://$main_domain/$ramdalias";

      
        
        
       
        
        
    } else {
      // The file size exceeds the limit
          echo "The file size exceeds the limit";
    }
    
} else {
    
    echo "The file type is not allowed";
  // The file type is not allowed
}




?>

