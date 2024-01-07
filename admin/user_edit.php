<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Edit User";

include 'header.php';


if(isset($_GET["id"]))
{

    include 'controllers/user_edit.php';

?>
       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit User </h1>

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

                          <label class="form-label">Status</label>
                          <select name="status" class="form-control" id="status"><option value="active" <?php if($status == "active") {    echo 'selected="selected"';    }  ?> >Active</option><option value="inactive" <?php if($status == "inactive") {    echo 'selected="selected"';    }  ?> >Inactive</option></select>
<br>

<label class="form-label">Plan</label>
                          <select name="plan" class="form-control" id="plan"><?php while($plan_data = mysqli_fetch_array($plan_query2)) {    ?> <option value="<?php  echo $plan_data['id'] ?>" <?php if($plan_data['id'] == $plan) {    echo 'selected="selected"';    }  ?> ><?php echo $plan_data['name']; ?></option>  <?php  } ?></select>
<br>

<label  class="form-label">Username</label>
<input type="txt" class="form-control form-control-user" value = "<?php echo $username;  ?>" name ="username">

<br>

<label class="form-label">Email</label>
<input type="txt" class="form-control" value = "<?php echo $email;  ?>" name = "email" >

<br>

<label class="form-label">Publisher Earnings</label>
<input type="txt" class="form-control" value = "<?php echo $publisher_earnings;  ?>" name = "pubearn" >

<br>

<label class="form-label">Referral Earnings</label>
<input type="txt" class="form-control" value = "<?php echo $referral_earnings;  ?>" name = "referearn" >

<br>

<label class="form-label">Referred By</label>
<input type="txt" class="form-control" value = "<?php echo $referby;  ?>" name = "referby" >

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


<?php  }
include 'footer.php';  ?>
