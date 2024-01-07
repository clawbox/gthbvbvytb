<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Add Plan";

include 'header.php';
include 'controllers/addplan.php';
?>
 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Add Plan </h1>

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

<label class="form-label">CPM</label>
<input type="text" class="form-control"  name = "cpm" >

<br>

 <label class="form-label">Enable Web Video Player</label>
 <select name="web" class="form-control" id="options-112-value"><option  value="1">Yes</option><option  value="0" >No</option></select>
 
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
