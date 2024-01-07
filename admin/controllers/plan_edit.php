<?php
$errmsg = "";
$errbox = false;
$user_id = $_GET['id'];
$sql = "SELECT * FROM `plan` WHERE id = '$user_id'";
$query = mysqli_query($con,$sql);
$res = mysqli_fetch_array($query);
$name = $res['name'];
$cpm = $res['cpm'];
$web = $res['web'];
if($_SERVER["REQUEST_METHOD"] == "POST") {   


    $name = $_POST['name'];
$cpm = $_POST['cpm'];
$web = $_POST['web'];
    $update_sql = "UPDATE `plan` SET`name`='$name' ,`cpm`='$cpm',`web`='$web' WHERE id = '$user_id'";
    $edit_res = mysqli_query($con,$update_sql);

    if($edit_res) {


        $errbox = true;
        $errmsg = "The Plan has been updated.";

        
       





    } else {




        $errbox = true;
        $errmsg = "Something was wrong.";


    }











}