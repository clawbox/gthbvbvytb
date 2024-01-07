<?php


include('Mobile_Detect.php');
include('BrowserDetection.php');



$browser=new Wolfcast\BrowserDetection;

$browser_name=$browser->getName();
$browser_version=$browser->getVersion();

$detect=new Mobile_Detect();

if($detect->isMobile()){
	$type='Mobile';
}elseif($detect->isTablet()){
	$type='Tablet';
}else{
	$type='PC';
}

if($detect->isiOS()){
	$os='IOS';
}elseif($detect->isAndroidOS()){
	$os='Android';
}else{
	$os='Window';
}

$url=(isset($_SERVER['HTTPS'])) ? "https":"http";
$url.="//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ref='Direct';
$refers='';


$urlcode = "https://$main_domain/".$l;
$urlcode2 = "https://$main_domain/$l/";
if(isset($_SERVER['HTTP_REFERER'])){
 $ref=$_SERVER['HTTP_REFERER'];


 


}
if($ref == $urlcode)  {

	$refers = "Direct";
 }

 else {

if($ref == $urlcode2)  {

	$refers = "Direct";
 } else {

$refers = $ref;

 }
}


$user_ip = $_SERVER['REMOTE_ADDR'];

