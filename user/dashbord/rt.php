<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";
if(isset($_POST['file'])) {


$fileName = $_POST['file'];
if($st_server == 1) {

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

$sql = "INSERT INTO `files`( `user_id`, `file_name`, `drn_name`, `alies`, `status`, `server`) VALUES ('$user_id','$fileName','uploads/videos/$fileName','$ramdalias','active','1')";
$run = mysqli_query($con,$sql);

}else {


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

$sql = "INSERT INTO `files`( `user_id`, `file_name`, `drn_name`, `alies`, `status`, `server`) VALUES ('$user_id','$fileName','$fileName','$ramdalias','active','$st_server')";
$run = mysqli_query($con,$sql);   




    
}

   

            }