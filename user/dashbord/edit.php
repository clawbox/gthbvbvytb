<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";

$pi = "Dashbord";
$act = "dashbord";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }

if(isset($_GET['id'])) {

$link_a = $_GET['id'];
$link_data_sql = "SELECT * FROM `files` WHERE user_id = '$user_id' AND alies ='$link_a'";
$link_data_query = mysqli_query($con,$link_data_sql);
$link_data_num = mysqli_num_rows($link_data_query);
if($link_data_num == 1) {
$link_data = mysqli_fetch_array($link_data_query);
$user_file = $link_data['user_id'];
if($user_file == $user_id) {
if(isset($_POST['title'])) {

    $title = $_POST['title'];
    $update_sql = "UPDATE `files` SET `file_name`='$title' WHERE alies = '$link_a'";
    $update_run = mysqli_query($con,$update_sql);
    header("Location: videos.php");
    
}


include 'header.php';
?>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
        

          <div class="section-body">
           
            <div class="card">
            <div class="card-body">
<form method="post" accept-charset="utf-8" >
<div class="form-group text "><label for="title">Title</label><input type="text" name="title" class="form-control" maxlength="200" id="title" value="<?php echo $link_data['file_name']; ?>"><span class="help-block"></span></div><br>
<button class="btn btn-sm btn-outline-primary" type="submit">Save</button>
</form> 
  </div>
              
            </div>
          </div>
        </section>
      </div>



<?php
include 'footer.php';
}
}
}
?>
