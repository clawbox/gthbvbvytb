<?php



$succ=false;

if(isset($_POST['name'])) {
$name = $_POST['name'];
$hostname = $_POST['hostname'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$port = $_POST['port'];
$Path = $_POST['path'];



$insert_sql = "INSERT INTO `server`( `name`, `hostname`, `username`, `password`, `path`, `port`) VALUES ('$name','$hostname','$username','$pass','$Path','$port')";
$insert = mysqli_query($con,$insert_sql);

// Close FTP connection


header("Location: server.php");

}

