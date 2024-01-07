<?php

$succ=false;

$list_sql = "SELECT * FROM `server` ";
$list_res = mysqli_query($con,$list_sql);

if(isset($_GET['type']) && $_GET['type']=='delete'){
    $link_a = $_GET['id'];
$check_sql = "SELECT * FROM `files` WHERE `server` = '$link_a'";
$check_query = mysqli_query($con,$check_sql);
$check = mysqli_num_rows($check_query);
    if($link_a == 1) {


        $succ=true;
        $massset = "You can not Delete Local Server";

    }elseif($check >0) {


        $succ=true;
        $massset = "You can not Delete this Server as same file are hosted in this server";

    }else {

$dele_sql = "DELETE FROM `server` WHERE id = '$link_a'";
$dele_query = mysqli_query($con,$dele_sql);




    }

}