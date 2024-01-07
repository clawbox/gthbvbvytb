<?php
if(isset($_POST['name'])) {

$namex = $_POST['name'];
$cpm = $_POST['cpm'];
$web = $_POST['web'];
$save_sql = "INSERT INTO `plan`( `name`, `cpm`, `web`) VALUES ('$namex','$cpm','$web')";
$save_query = mysqli_query($con,$save_sql);
header("Location: plan.php");



}


?>