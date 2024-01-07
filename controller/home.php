<?php
$name_sql = "SELECT * FROM `settings` WHERE id = '1'";
$name_query = mysqli_query($con,$name_sql);
$name_data = mysqli_fetch_assoc($name_query);
$name = $name_data['value'];
$main_domain_sql = "SELECT * FROM `settings` WHERE id = '3'";
$main_domain_query = mysqli_query($con,$main_domain_sql);
$main_domain_data = mysqli_fetch_assoc($main_domain_query);
$main_domain = $main_domain_data['value'];
// favicon_url 

$favicon_url_sql = "Select * from settings where id = 11";
$favicon_url_query = mysqli_query($con,$favicon_url_sql);
$favicon_url_data = mysqli_fetch_array($favicon_url_query);
$favicon_url = $favicon_url_data['value'];

// Logo URL
$logo_url_sql = "Select * from settings where id = 12";
$logo_url_query = mysqli_query($con,$logo_url_sql);
$logo_url_data = mysqli_fetch_array($logo_url_query);
$logo_url = $logo_url_data['value'];

// Meta Description 
$Description_sql = "Select * from settings where id = 2";
$Description_query = mysqli_query($con,$Description_sql);
$Description_data = mysqli_fetch_array($Description_query);
$Description = $Description_data['value'];

// Site Maintenance 

$mainten_sql = "Select * from settings where id = 13 ";
$mainten_query = mysqli_query($con,$mainten_sql);
$mainten_data = mysqli_fetch_array($mainten_query);
$site_maintenance = $mainten_data['value'];



