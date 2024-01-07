<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "View User";

include 'header.php';


if(isset($_GET["id"]))
{

    include 'controllers/view.php';

?>
       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">View User </h1>

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
                      
                          <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                    <td>Id</td>
                                    <td><?php echo $user_id;    ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?php echo $status;    ?></td>
                                </tr>
                                <tr>
                                    <td>Plan</td>
                                    <td><?php echo $plan_name;    ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $username;  ?></td>
                                </tr>
                              
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $email;  ?></td>
                                </tr>
                               
                               
                                
                                <tr>
                                    <td>Current Publisher Earnings</td>
                                    <td>$<?php echo $publisher_earnings;  ?></td>
                                </tr>
                                <tr>
                                    <td>Current Referral Earnings</td>
                                    <td>$<?php echo $referral_earnings;  ?></td>
                                </tr>
                              
                                <tr>
                                    <td>Withdrawal Method</td>
                                    <td><?php echo $withdrawal_method;  ?></td>
                                </tr>
                                <tr>
                                    <td>Withdrawal Account</td>
                                    <td><?php echo $withdrawal_account ;  ?></td>
                                </tr>
                               
                                <tr>
                                    <td>Created</td>
                                    <td><?php echo $joined;  ?></td>
                                </tr>
                               
                            </tbody></table>
                       
                             </div>
                             <div class="card-body">
                             <a href="user_edit.php?id=<?php echo $user_id; ?>" class="btn btn-success btn-icon-split">
                                      
                                        <span class="text">Edit </span>
                                    </a>
                                  
                                    <a href ="?id=<?php echo $user_id; ?>&ban=<?php echo $user_id; ?>" class="btn btn-danger btn-icon-split">
                                       
                                        <span class="text">Ban</span>
                                    </a>
                                    </div>
                          </div>
                       </div>
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
