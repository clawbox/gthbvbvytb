<?php
$main_domain_sql = "SELECT * FROM `settings` WHERE id = '3'";
$main_domain_query = mysqli_query($con,$main_domain_sql);
$main_domain_data = mysqli_fetch_assoc($main_domain_query);
$main_domain = $main_domain_data['value'];
$remote_upload_api = "https://$main_domain/uploads/videos/re-upload.php";
$remote_upload_api2 = "https://$main_domain/user/dashbord/rt.php";