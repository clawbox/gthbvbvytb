<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Add Server";

include 'header.php';
include 'controllers/addserver.php';
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add FTP Storage Server </h1>
                   
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
        <!-- Page Content Start -->
        <!-- ================== -->
        <div class="wraper container-fluid">
           <div class="page-title">
            
           </div>
           <div class="row">
              <div class="col-md-12">
                 <div class="panel panel-default">
                    
                    <div class="panel-body">
                       <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                      
                          <form method ="POST">

                    

     

<label  class="form-label">Name</label>
<input type="text" class="form-control form-control-user"  name ="name">

<br>

<label class="form-label">Hostname</label>
<input type="text" class="form-control"  name = "hostname" >

<br>
<label class="form-label">Username</label>
<input type="text" class="form-control"  name = "username" >

<br>

<label class="form-label">Password</label>
<input type="password" class="form-control"  name = "pass" >

<br>
<label class="form-label">Port</label>
<input type="text" class="form-control"  name = "port" >

<br>
<label class="form-label">Path</label>
<input type="text" class="form-control"  name = "path" >

<br>

<button type="submit" class="btn btn-primary">Submit</button>
</form>
<br>

<br>
                   
                    </div>
                 </div>
              </div>
           </div>
           
        </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php


include 'footer.php';  ?>
