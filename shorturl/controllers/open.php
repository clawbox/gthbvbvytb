<?php
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
// Retrieve the JSON data from the POST request
$json = file_get_contents('php://input');

// Decode the JSON data
$data = json_decode($json, true);
$czount = "";
// Do something with the data

$alies = $data['alies'];
$file_data_sql = "SELECT * FROM `files` WHERE `alies` = '$alies'";
$file_data_query = mysqli_query($con,$file_data_sql);
$file_data = mysqli_fetch_array($file_data_query);
$user_id = $file_data['user_id'];
$link_id = $file_data['id'];
$user_ip = $data['user_ip'];
$referer_domain = $data['referer_domain'];
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$contry=curl_exec($ch);
$contry=json_decode($contry);

$url = "https://api.ipinfodb.com/v3/ip-country/?key=46e3a1695c17ed734497eb670943c9071bb0f0fd5f21a5c43bff959e8ef07f91&ip=$user_ip&format=json";
$urlcontent = file_get_contents($url);
$ctrydata = json_decode($urlcontent);
$ctry = $ctrydata ->countryName;
$countryCode = $ctrydata ->countryCode;
$cpm_sql = "SELECT * FROM `cpm` WHERE `code` = '$countryCode'";
$cpm_query = mysqli_query($con,$cpm_sql);
$cpm_num = mysqli_num_rows($cpm_query);

if($cpm_num == 1) {

$cpm_data = mysqli_fetch_array($cpm_query);
$cpm = $cpm_data['value'];



} else {

    $cpm_sql = "SELECT * FROM `cpm` WHERE `code` = 'World'";
    $cpm_query = mysqli_query($con,$cpm_sql);
    $cpm_data = mysqli_fetch_array($cpm_query);
$cpm = $cpm_data['value'];


}

$refer_sql = "Select * from settings where id = 6 ";
$refer_query = mysqli_query($con,$refer_sql);
$refer_data = mysqli_fetch_array($refer_query);
$refer = $refer_data['value'];

$refer_percentage = $refer;

$refer_earn ="";
$refer_check_sql = "Select * from users where id = '$user_id' ";
$refer_check_query = mysqli_query($con,$refer_check_sql);
$refer_check_ress = mysqli_fetch_array($refer_check_query);
$refer_check_value = $refer_check_ress['referred_by'];
if($refer_check_value == '0') {

$refer_earn = "0.0000";


}


else {

    $refer_earn_value = $refer_percentage/100 * $uprate;
    $refer_earn = $refer_earn_value;


}
$plan_id = $refer_check_ress['plan'];
if($plan_id >1) {
$plan_sql = "SELECT * FROM `plan` WHERE id = '$plan_id'";
$plan_query = mysqli_query($con,$plan_sql);
$plan_data = mysqli_fetch_array($plan_query);
$cpm = $plan_data['cpm'];


}
$uprate = $cpm/1000;

$date= date("Y-m-d") ;
$from = $date. " 00:00:00";
$to = $date. " 23:59:59";

$ipchacker = "SELECT * FROM  statistics WHERE created >= '$from' AND created <= '$to' AND ip ='$user_ip' ";
$ipquery =mysqli_query($con,$ipchacker);

$ipfinel =mysqli_num_rows($ipquery);
while($videoplay_data = mysqli_fetch_array($ipquery)) {
$link_iddx = $videoplay_data['link_id'];

if($link_iddx == $link_id) {
echo "error";
$czount = 22;
}

else  {


if(empty($czount)) {
    $czount = 11;
    
    
}




}

}
if($czount ==11) {
    
    
    
    if(!$refer_check_value == '0') {  
    mysqli_query($con,"update users set referral_earnings=referral_earnings+$refer_earn where id='$refer_check_value'");
    

}



mysqli_query($con,"INSERT INTO `statistics` ( `link_id`, `user_id`, `referral_id`, `ip`, `country`, `publisher_earn`, `referral_earn`, `referer_domain` ) VALUES ( '$link_id', '$user_id', '$refer_check_value', '$user_ip', '$ctry', '$uprate', '$refer_earn', '$referer_domain')");
mysqli_query($con,"update users set publisher_earn= publisher_earn+$uprate where id='$user_id'");

echo $plan_id;
}
if($ipfinel == 0) {

if(!$refer_check_value == '0') {  
    mysqli_query($con,"update users set referral_earnings=referral_earnings+$refer_earn where id='$refer_check_value'");
    

}



mysqli_query($con,"INSERT INTO `statistics` ( `link_id`, `user_id`, `referral_id`, `ip`, `country`, `publisher_earn`, `referral_earn`, `referer_domain` ) VALUES ( '$link_id', '$user_id', '$refer_check_value', '$user_ip', '$ctry', '$uprate', '$refer_earn', '$referer_domain')");
mysqli_query($con,"update users set publisher_earn= publisher_earn+$uprate where id='$user_id'");

echo $plan_id;


}


?>