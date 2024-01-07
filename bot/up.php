<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";

$user_id = $_POST['userId'];

$user_id_sql = "SELECT * FROM users WHERE api_key = '$user_id'";
$user_id_query = mysqli_query($con,$user_id_sql);
$user_data = mysqli_fetch_assoc($user_id_query);
$userid = $user_data['id'];
// (A) HELPER FUNCTION - SERVER RESPONSE
function verbose ($ok=1, $info="") {
  if ($ok==0) { http_response_code(400); }
  exit(json_encode(["ok"=>$ok, "info"=>$info]));
}

// (B) INVALID UPLOAD
if (empty($_FILES) || $_FILES['video']["error"]) {
  verbose(0, "Failed to move uploaded file.");
}

// (C) UPLOAD DESTINATION - CHANGE FOLDER IF REQUIRED!
$filePath = $_SERVER['DOCUMENT_ROOT'] ."/uploads/videos";
if (!file_exists($filePath)) { if (!mkdir($filePath, 0777, true)) {
  verbose(0, "Failed to create $filePath");
}}
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES['video']["name"];
$filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;
$fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
// Check if the file extension is allowed
$allowedExtensions = ['mp4', 'mov', 'avi', 'wmv', 'mkv']; // Add any other video file extensions you want to allow
if (!in_array($fileExtension, $allowedExtensions)) {
  verbose(0, "Invalid file format. Only MP4, MOV, AVI, WMV, and MKV files are allowed.");
}


// (D) DEAL WITH CHUNKS
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
  $in = @fopen($_FILES['video']["tmp_name"], "rb");
  if ($in) { while ($buff = fread($in, 4096)) { fwrite($out, $buff); } }
  else { verbose(0, "Failed to open input stream"); }
  @fclose($in);
  @fclose($out);
  @unlink($_FILES['video']["tmp_name"]);
} else { verbose(0, "Failed to open output stream"); }

// (E) CHECK IF FILE HAS BEEN UPLOADED
if (!$chunks || $chunk == $chunks - 1) { rename("{$filePath}.part", $filePath); 
      if(empty($userid)) {
           
           
           echo "API Key is wrong or no api key getting";
           die();
       }
       $maxFileSize = 3 * 1024 * 1024 * 1024; // 3GB in bytes
  $fileSize = filesize($filePath);
  if ($fileSize > $maxFileSize) {
    unlink($filePath);
    verbose(0, "File size exceeds the maximum limit of 3GB.");
  }
    // Generate a unique identifier
$uniqueName = uniqid();

// Extract the file extension
$fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

// Create the new file name
$newFileName = $uniqueName . '.' . $fileExtension;

// Get the directory path of the file
$directory = dirname($filePath);

// Create the new file path
$newFilePath = $directory . '/' . $newFileName;
rename($filePath, $newFilePath);
     function random_strings($length_of_string)
                {
                  
                    // String of all alphanumeric character
                    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                  
                    // Shuffle the $str_result and returns substring
                    // of specified length
                    return substr(str_shuffle($str_result), 
                                       0, $length_of_string);
                }
                
                $ramdalias = random_strings(5);
    
            $sql = "INSERT INTO `files`( `user_id`, `file_name`, `drn_name`, `alies`, `status`) VALUES ('$userid','$fileName','$newFileName','$ramdalias','active')";
       $run = mysqli_query($con,$sql);
       if ($run) {
    echo "https://$main_domain/$ramdalias";
} else {
    echo mysqli_error($con);
}
}




?>