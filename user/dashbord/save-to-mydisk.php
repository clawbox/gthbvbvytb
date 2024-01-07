<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/withdraws.php";

$pi = "Save To My Disk";
$act = "save";

$urlx = "";
if(isset($_GET['url'])) {
 $urlx = $_GET['url'];
   
    
    
}
if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }
   $errorz = false;
if(isset($_POST['link'])) {
$link = $_POST['link'];
$linkx = parse_url($link);
$path = pathinfo(parse_url($link, PHP_URL_PATH), PATHINFO_BASENAME);
$host = $linkx['host'];
if($main_domain == $host) {
$file_sqlz = "SELECT * FROM `files` WHERE `alies` = '$path'";
$file_queryz = mysqli_query($con,$file_sqlz);
$file_numz = mysqli_num_rows($file_queryz);
if($file_numz == 1) {


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
    $file_dataz = mysqli_fetch_array($file_queryz);
    $drn_name = $file_dataz['drn_name'];
    $file_status = $file_dataz['status'];
    $file_name = $file_dataz['file_name'];
    $st_serverxz = $file_dataz['server'];
    if($file_status == "active") {
        $sql = "INSERT INTO `files`( `user_id`, `file_name`, `drn_name`, `alies`, `status`, `server`) VALUES ('$user_id','$file_name','$drn_name','$ramdalias','active','$st_serverxz')";
        $run = mysqli_query($con,$sql);
        header("Location: videos.php");

    }

}else {

    $errorz = true;
    $msgz = "Not Found ";
    
    
    }
   


}else {

$errorz = true;
$msgz = "Invalid Link";


}


  
}

include 'header.php';
?>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
        

          <div class="section-body">
           
            <div class="card">
<div class="card-body">
<?php  if($errorz) { ?>
<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle"></i> <?php echo $msgz; ?></div>
<?php }  ?>
    <h5>Save To Mydisk</h5>
<form method="post" accept-charset="utf-8">
<div class="form-group text "><label for="file">File Link</label><input type="text" name="link"  class="form-control" value="<?php echo $urlx; ?>"><span class="help-block"></span></div><br>
<button class="btn btn-sm btn-outline-primary" type="submit">Save To Mydisk</button>
</form> </div>
 </div>
          </div>
        </section>
      </div>
>
<?php
include 'footer.php';

?>
