<?php


$succ=false;
$errbox = false;
$with_id = $_GET['id'];
$list_sql = "SELECT * FROM `withdraw_methods` WHERE id = '$with_id' ";
$list_res = mysqli_query($con,$list_sql);
$list_data = mysqli_fetch_array($list_res);
$get_name = $list_data['name'];
$get_amount = $list_data['amount'];





if(isset($_POST['name'])) {

 $name = $_POST['name'];
 $min = $_POST['amount'];

$update_sql  = "UPDATE `withdraw_methods` SET `name`='$name',`amount`='$min' WHERE id = '$with_id'";
$update_res = mysqli_query($con,$update_sql);

if($update_res) {

    $succ=true;
    $massset = "Withdraw Method was Successfully Updated.";


    $get_name = $_POST['name'];
    $get_amount = $_POST['amount'];
} else {
    $succ=true;
    $massset = "Something was Wrong.";

}







}



















?>