<?php
$sql = "SELECT * FROM `cpm`  ";
$query = mysqli_query($con,$sql);


if(isset($_POST['IN'])) {
$IN = $_POST['IN'];
$US = $_POST['US'];
$UK = $_POST['UK'];
$CA = $_POST['CA'];
$ID = $_POST['ID'];
$UAE = $_POST['UAE'];
$PK = $_POST['PK'];
$BD = $_POST['BD'];
$AU = $_POST['AU'];
$DE = $_POST['DE'];
$FR = $_POST['FR'];
$PH = $_POST['PH'];
$MY = $_POST['MY'];
$SA = $_POST['SA'];
$World = $_POST['World'];

$update = "UPDATE cpm SET value ='$IN'   WHERE id= 1 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$US'   WHERE id= 2 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$UK'   WHERE id= 3 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$CA'   WHERE id= 4 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$ID'   WHERE id= 5 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$UAE'   WHERE id= 6 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$PK'   WHERE id= 7 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$BD'   WHERE id= 8 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$AU'   WHERE id= 9 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$DE'   WHERE id= 10 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$FR'   WHERE id= 11 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$PH'   WHERE id= 12 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$MY'   WHERE id= 13 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$SA'   WHERE id= 14 ";
$result = mysqli_query($con,$update);
$update = "UPDATE cpm SET value ='$World'   WHERE id= 15 ";
$result = mysqli_query($con,$update);
$succ=true;
$massset = "Settings Update Successful ";




}