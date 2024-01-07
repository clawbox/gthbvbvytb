<?php

$id = $_GET['id'];
$succ=false;
$sql = "SELECT * FROM `announcements` WHERE id = '$id'";
$data = mysqli_query($con,$sql);
$res = mysqli_fetch_array($data);
$ti = $res['title'];
$conten =   $res['content']; 


if(isset($_POST['title'])) {

 $title = $_POST['title'];
 $content = $_POST['content'];
 $update_sql = "UPDATE `announcements` SET `title`='$title',`content`='$content' WHERE id = '$id'";
 $update_res = mysqli_query($con,$update_sql);
if($update_res) {

    $succ=true;
    $massset = "Announcements was Successfully Updated Refresh The Page To See Update.";
    $ti = $_POST['title'];
    $conten = $res['content'];


}  else {
    $succ=true;
    $massset = "Something was Wrong.";

}











}

















?>