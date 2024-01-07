<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Edit Link";
include 'header.php';


if(isset($_GET["id"]))
{

    include 'controllers/link.php';

?>
       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit File </h1>

        <!-- Page Content Start -->
        <!-- ================== -->
        <div class="wraper container-fluid">
           <div class="page-title">
               <?php

             if($errbox) {       ?>
           <div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body">
                                    <?php  echo  $errmsg;  ?>
                                </div>
                            </div>
             

       <?php } ?>
           </div>
           <div class="row">
              <div class="col-md-12">
                 <div class="panel panel-default">
                    
                    <div class="panel-body">
                       <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                      
                          <form method ="POST">

                        

     

<label  class="form-label">File name  </label>
<input type="txt" class="form-control form-control-user" value = "<?php echo $link;  ?>" name ="file">



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

} else {?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- 404 Error Text -->
<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="dashbord.php">&larr; Back to Dashboard</a>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->






<?php } include 'footer.php';  ?>