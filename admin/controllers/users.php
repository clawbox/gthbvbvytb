<?php


$start = 0;
$per_page = 10;
$current_page = 1;
if(isset($_GET['page'])) {


$start = $_GET['page'];
$current_page = $start;
$start --;
$start = $start*$per_page;



}

$user_sql = "SELECT * FROM `users` ORDER BY id DESC limit $start,$per_page ";
$user_res = mysqli_query($con,$user_sql);














?>