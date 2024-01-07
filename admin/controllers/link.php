<?php

$errmsg = "";
$errbox = false;
$link_id = $_GET['id'];
$sql = "SELECT * FROM `files` WHERE id = '$link_id'";
$query = mysqli_query($con,$sql);
$res = mysqli_fetch_array($query);
$link = $res['file_name'];



if($_SERVER["REQUEST_METHOD"] == "POST") {   

 $file_name = $_POST['file'];

 $update_link_sql = "UPDATE `files` SET `file_name`='$file_name' WHERE id = '$link_id'";
 $update_link_res = mysqli_query($con,$update_link_sql);

 if($update_link_res) {


    $errbox = true;
    $errmsg = "The Link has been updated.";
    $link = $_POST['file'];
   
    

 } else {

  
    $errbox = true;
    $errmsg = "Something was wrong.";





 }





 











}



































?>