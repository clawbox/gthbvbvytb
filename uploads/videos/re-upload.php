<?php

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/user/dashbord/vendor/autoload.php";
header('Access-Control-Allow-Origin: *');
header('content-type: application/json; charset=utf-8');

// error_reporting(0);
set_time_limit(0);
use phpseclib3\Net\SFTP;

$st_server_sql = "SELECT * FROM `settings` WHERE id = '18'";
$st_server_query = mysqli_query($con, $st_server_sql);
$st_server_data = mysqli_fetch_assoc($st_server_query);
$st_server = $st_server_data['value'];

if ($st_server == 1) {



function largeDownload($url,$path){
   
    $fp = fopen($path, 'w');
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_FILE, $fp);
    $data = curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    return $data;
}

/*
 * Get the remote file size
 * In rare cases, it does not work well, but its good.
*/
function remote_filesize($url) {
    static $regex = '/^Content-Length: *+\K\d++$/im';
    if (!$fp = @fopen($url, 'rb')) {
        return false;
    }
    if (
        isset($http_response_header) &&
        preg_match($regex, implode("\n", $http_response_header), $matches)
    ) {
        return (int)$matches[0];
    }
	return strlen(stream_get_contents($fp));
}

/*
 * Readable file size
 * Very Dirty function for make Readable filesize, you can change
*/
function formatSizeUnits($bytes)
{
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' Bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' Bytes';
        }
        else
        {
            $bytes = '0 Bytes';
        }

        return $bytes;
}

/*
 * Get the uploaded progress percentage
*/
function getProgress($name)
{
	$log  = md5($name);
	
	$total_size = file_get_contents($log . '.txt');
	
	$current_size = filesize($name);
	
	$progress = ( 100 * $current_size ) / $total_size;
	$progress = floor($progress);

	return json_encode(array(
		'progress'  => $progress,
		'uploaded'  => formatSizeUnits($current_size),
		'size' 	    => formatSizeUnits($total_size)
	));
}

/*
 Start download file
*/
function downloadFile($url,$name)
{
	$url = urldecode($url);
	
	$status = true;
	
	$put = file_put_contents(md5($name) . '.txt', remote_filesize($url));
	
	if(!$put)
	{
		//$status = false;
		return;
	}
    $uniqueName = md5(uniqid()) . '_' . $name;

    // Specify the directory where you want to save the files
    $saveDirectory = $_SERVER['DOCUMENT_ROOT'] ."/uploads/videos/";

    // Full path for the new file
    $filePath = $saveDirectory . $uniqueName;
	//Download File Can be Start from here
	largeDownload($url, $name);

	return json_encode(
		array(
			'status'   => $status,
			'filename' => $name
		)
	);
}

/*
 * Get the file progress
*/
if(isset($_REQUEST['progress']) && !empty($_REQUEST['progress'])){

  exit(getProgress(trim($_REQUEST['name'])));
}

$url  = trim($_REQUEST['url']); // File url
$name = trim($_REQUEST['name']); // File name

if(!isset($url) && empty($name)) die();

if(!filter_var($url, FILTER_VALIDATE_URL)) {
	die();
}


$check_ext = substr($name,-3);
$allowed = ['mkv','mp4']; // Alowed file types

/*
 * Download File
*/
if(in_array($check_ext,$allowed)){
	exit(downloadFile($url,basename($name)));
}
}else {


    $server_data_sql = "SELECT * FROM `server` WHERE id = '$st_server'";
    $server_data_query = mysqli_query($con,$server_data_sql);
    $server_data = mysqli_fetch_assoc($server_data_query);
    $host = $server_data['hostname'];
    $username = $server_data['username'];
    $password = $server_data['password'];
    $remoteDirectory = $server_data['path'];
   

function largeDownload($url,$path,$remoteDirectory,$host,$username,$password){
   
  
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Curl Error: ' . curl_error($ch));
    }

    $remoteFilePath = $remoteDirectory . $path;
    // Initialize the SFTP object
$sftp = new SFTP($host);

// Connect to the FTP server
if (!$sftp->login($username, $password)) {
    exit('Login Failed');
}

// Move the uploaded file to the remote directory
if (!$sftp->put($remoteFilePath, $data, SFTP::SOURCE_STRING)) {
    exit('File Upload Failed');
}
    curl_close($ch);
    return $data;
}

/*
 * Get the remote file size
 * In rare cases, it does not work well, but its good.
*/
function remote_filesize($url) {
    static $regex = '/^Content-Length: *+\K\d++$/im';
    if (!$fp = @fopen($url, 'rb')) {
        return false;
    }
    if (
        isset($http_response_header) &&
        preg_match($regex, implode("\n", $http_response_header), $matches)
    ) {
        return (int)$matches[0];
    }
	return strlen(stream_get_contents($fp));
}

/*
 * Readable file size
 * Very Dirty function for make Readable filesize, you can change
*/
function formatSizeUnits($bytes)
{
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' Bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' Bytes';
        }
        else
        {
            $bytes = '0 Bytes';
        }

        return $bytes;
}

/*
 * Get the uploaded progress percentage
*/function getProgress($name, $remoteDirectory, $host, $username, $password)
{
    $log = md5($name);
    $total_size = file_get_contents($log . '.txt');
    $current_size = getRemoteFileSize($remoteDirectory . $name, $host, $username, $password);
    $progress = (100 * $current_size) / $total_size;
    $progress = floor($progress);

    return json_encode(array(
        'progress' => $progress,
        'uploaded' => formatSizeUnits($current_size),
        'size' => formatSizeUnits($total_size)
    ));
}

function getRemoteFileSize($remoteFilePath, $host, $username, $password)
{
    $sftp = new SFTP($host);
    if (!$sftp->login($username, $password)) {
        exit('Login Failed');
    }

    $fileInfo = $sftp->stat($remoteFilePath);

    if ($fileInfo === false) {
        exit('Failed to get file information');
    }

    return $fileInfo['size'];
}


/*
 Start download file
*/
function downloadFile($url,$name,$remoteDirectory,$host,$username,$password)
{
	$url = urldecode($url);
	
	$status = true;
	
	$put = file_put_contents(md5($name) . '.txt', remote_filesize($url));
	
	if(!$put)
	{
		//$status = false;
		return;
	}
    $uniqueName = md5(uniqid()) . '_' . $name;

    // Specify the directory where you want to save the files
    $saveDirectory = $_SERVER['DOCUMENT_ROOT'] ."/uploads/videos/";

    // Full path for the new file
    $filePath = $saveDirectory . $uniqueName;
	//Download File Can be Start from here
	largeDownload($url, $name,$remoteDirectory,$host,$username,$password);

	return json_encode(
		array(
			'status'   => $status,
			'filename' => $name
		)
	);
}

/*
 * Get the file progress
*/
if (isset($_REQUEST['progress']) && !empty($_REQUEST['progress'])) {
    exit(getProgress(trim($_REQUEST['name']), $remoteDirectory, $host, $username, $password));
}

$url  = trim($_REQUEST['url']); // File url
$name = trim($_REQUEST['name']); // File name

if(!isset($url) && empty($name)) die();

if(!filter_var($url, FILTER_VALIDATE_URL)) {
	die();
}


$check_ext = substr($name,-3);
$allowed = ['mkv','mp4']; // Alowed file types

/*
 * Download File
*/
if(in_array($check_ext,$allowed)){
	exit(downloadFile($url,basename($name),$remoteDirectory,$host,$username,$password));
}


}
?>
