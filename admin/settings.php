<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Settings";
include 'header.php';
include 'controllers/settings.php';



?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">General Settings </h1>
                    <?php

if($succ) {
?>
<div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body">
                                <?php echo $massset ;   ?>
                                </div>
                            </div>




<br>
<br>
<?php

}
?>

                    <form method ="POST">
                    <label  class="form-label">Maintenance Mode</label>
                    <select name="maintenance" class="form-control" ><option value="1" <?php if($site_maintenance == "1") {  echo 'selected="selected"'; }  ?>>Enable</option><option <?php if($site_maintenance == "0") {  echo 'selected="selected"'; }  ?> value="0" >Disable</option></select>
                    <br>
    <label  class="form-label">Site name</label>
    <input type="txt" class="form-control form-control-user" value = "<?php echo $site_name;  ?>" name ="sitename">
  
    <br>
 
    <label class="form-label">Description</label>
    <input type="txt" class="form-control" value = "<?php echo $site_dis;  ?>" name = "discription" >
   
    <br>

    <label class="form-label">Favicon Url</label>
    <input type="txt" class="form-control" value = "<?php echo $favicon_url;  ?>" name = "favicon_site" >
   
    <br>

    <label class="form-label">Logo Url</label>
    <input type="txt" class="form-control" value = "<?php echo $logo_url;  ?>" name = "logo">
    <br>
 


  
 <label class="form-label">Refer Percentage</label>
    <input type="number" class="form-control" value = "<?php echo $refer;  ?>" name = "refer" >
   
 <br>

  
 

  
 <label class="form-label">Main Domain</label>
    <input type="txt" class="form-control" value = "<?php echo $main_domain;  ?>" name = "maindomain" >
   
 <br>
 <label class="form-label">Short Domain</label>
    <input type="txt" class="form-control" value = "<?php echo $short;  ?>" name = "short" >
   
 <br>
  

 <label class="form-label">Inactive File delete</label>
    <input type="txt" class="form-control" value = "<?php echo $inactive;  ?>" name = "inactive" >
   
 <br>
 <label class="form-label">Close Registration</label>
 <select name="close" class="form-control" id="options-112-value"><option <?php if($close_registration == "1") { echo 'selected="selected"';  } ?> value="1">Yes</option><option <?php if($close_registration == "0") { echo 'selected="selected"';  } ?> value="0" >No</option></select>
 
 <br>
 <label class="form-label">Default Server</label>
 <select name="server" class="form-control" id="options-112-value">
 <?php 
 $method_sql = "SELECT * FROM `server`";
 $method_query = mysqli_query($con,$method_sql);
 
 while($method_res = mysqli_fetch_array($method_query))  {

?>
<option <?php

if($st_server == $method_res['id']){ echo 'selected="selected"' ; }  ?> value="<?php  echo $method_res['id'];?>"><?php  echo $method_res['name'];?></option> 


<?php
    }?>


 </select>
 
 <br>
 <label class="form-label">Enable Withdraw</label>
 <select name="with" class="form-control" id="options-112-value"><option <?php if($withdraw == "1") { echo 'selected="selected"';  } ?> value="1">Yes</option><option <?php if($withdraw == "0") { echo 'selected="selected"';  } ?> value="0" >No</option></select>
 
 <br>
 <label class="form-label">Enable Download</label>
 <select name="down" class="form-control" id="options-112-value"><option <?php if($down == "1") { echo 'selected="selected"';  } ?> value="1">Yes</option><option <?php if($down == "0") { echo 'selected="selected"';  } ?> value="0" >No</option></select>
 
 <br>
 <label class="form-label">Enable Web Video Player</label>
 <select name="web" class="form-control" id="options-112-value"><option <?php if($web == "1") { echo 'selected="selected"';  } ?> value="1">Yes</option><option <?php if($web == "0") { echo 'selected="selected"';  } ?> value="0" >No</option></select>
 
 <br>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
<br>
<br>

<h1 class="h3 mb-4 text-gray-800">Change Password</h1>


<form method ="POST">
                   
    <label  class="form-label">Current Password</label>
    <input type="password" name="cpassword" class="form-control">
  
    <br>
 
    <label class="form-label">New Password</label>
    <input type="password" name="new1pass" class="form-control">
   
    <br>

 
 <label class="form-label">Re-enter New Password</label>
 <input type="password" name="new2pass" class="form-control" >
   
 <br>
 <button type="submit" class="btn btn-primary">Chanage Now</button>
</form>

                </div>
                <!-- /.container-fluid -->
<br>
<br>
            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php';  ?>

          