<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";

if(isset($_GET['id'])) {
    $report_id = $_GET['id'];
    $delete_sql = "DELETE FROM `reports` WHERE id = '$report_id'";
    $delete = mysqli_query($con,$delete_sql);
    header("Location: reports.php");

}


?>