<?php


$succ=false;

$list_sql = "SELECT * FROM `withdraw_methods` ";
$list_res = mysqli_query($con,$list_sql);

if(isset($_POST['name'])) {
$name = $_POST['name'];
$amount = $_POST['amount'];
$chack_sql = "SELECT * FROM `withdraw_methods` WHERE name = '$name'";
$chack_data = mysqli_query($con,$chack_sql);
$chcack = mysqli_num_rows($chack_data);
if($chcack == 1) {
    $succ=true;
    $massset = "Withdraw Method Already Exist.";
} else {
$sql = "INSERT INTO `withdraw_methods`( `name`,`shows`, `amount`) VALUES ('$name','$name','$amount')";
$res = mysqli_query($con,$sql);
if($res) {

    $succ=true;
    $massset = "Withdraw Method was Successfully Added Refresh The Page To See Update.";

}else {
    $succ=true;
    $massset = "Something was Wrong.";

}

} 

}

if(isset($_POST['id'])) {


 $id = $_POST['id'];

 $delete_sql = "DELETE FROM `withdraw_methods` WHERE id = '$id' ORDER BY id DESC";
 $delete_res = mysqli_query($con,$delete_sql);
 if($delete_res) {

    $succ=true;
    $massset = "Withdraw Method was Successfully Deleted Refresh The Page To See Update.";



 } else {
    $succ=true;
    $massset = "Something was Wrong.";

}












}








?>