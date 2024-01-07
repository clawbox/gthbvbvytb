<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "View Withdraws";
include 'header.php';


if(isset($_GET["id"]))
{   include 'controllers/chacking.php';

?>

 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">View Withdraws</h1>

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
<br>
           <?php  if($stat == "2") { ?>
                                        
                                    <form method ="POST">

                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="appid" value="<?php echo  $with_id;?>">     
                                    
                                    <button type="submit" class="btn btn-success btn-block"> <span class="text">Approve</span></button>
                                   
                                       

                                    </form>
                                 
                                    <form method ="POST">
                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="cancelid" value="<?php echo $with_id;?>"> 
                                    <button type="submit" class="btn btn-danger btn-block" > <span class="text">Cancel</span></button>
                                    </form>
                                    
                                  

                                 <?php 
                                                }
                                     
                                                if($stat == "1") { 

                                    
                                        ?>
                                       
                                     
                                    <form method ="POST">

                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="campleteid" value="<?php echo $with_id;?>"> 

                                    <button type="submit" class="btn btn-success btn-block" >  <span class="text">Complete</span></button>
                                    
                                    </form>
                                    <form method ="POST">
                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="cancelid" value="<?php echo $with_id;?>"> 
                                   <button type="submit" class="btn btn-danger btn-block" > <span class="text">Cancel</span></button>
                                   </form>
                               
                                 <?php  } if($stat == "3") {   ?>

                                
                                  

                               <?php }   if($stat == "4") {   ?>



<?php }  if($stat == "5") {   ?>


 

<?php }  ?>



           
           </div>
           <div class="row">
              <div class="col-md-12">
                 <div class="panel panel-default">
                    
                    <div class="panel-body">
                       <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">

                          <table class="table table-bordered">
            <tbody><tr>
                <td>ID</td>
                <td><?php echo $_GET['id']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo $status;  ?></td>
            </tr>
            <tr>
                <td>Publisher Earnings</td>
                <td>$<?php echo $publisher_earnings;  ?></td>
            </tr>
            <tr>
                <td>Referral Earnings</td>
                <td>$<?php echo $referral_earnings;  ?></td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>$<?php echo $amount;  ?></td>
            </tr>
            <tr>
                <td>Withdrawal Method</td>
                <td><?php echo $method;  ?></td>
            </tr>
            <tr>
                <td>Withdrawal Account</td>
                <td>                                   <?php  echo $resss['account'];  ?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td>
                    <a href="view.php?id=<?php echo $user_id ;?>" target="_blank"><?php echo $username  ?></a>                </td>
            </tr>
            <tr>
                <td>Created Date</td>
                <td><?php echo $created;  ?></td>
            </tr>
        </tbody></table>
        <div class="card shadow mb-4">
                                <div class="card-header py-3">
      
        <h5 class="box-title">  <i class="fa fa-globe"></i> Countries</h5>

        <div class="box-body" style="height: 300px; overflow: auto;">
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Country</th>
                <th>Count</th>
                <th>Publisher Earnings</th>
            </tr>
            </thead>
                            <tbody>
                            <?php while($statistics_data = mysqli_fetch_array($statistics_query)) { 
                                
                                $country = $statistics_data['country'];
                                $pub_earn_sql = "SELECT SUM(publisher_earn) AS publisher_earn_sum FROM statistics  WHERE user_id ='$user_id' AND created <= '$created' AND country = '$country'";
                                $pub_earn_query = mysqli_query($con,$pub_earn_sql);
                                $pub_earn_res = mysqli_fetch_array($pub_earn_query);


                                
                                ?>    
                            
                            <tr>
                    <td><?php echo $statistics_data['country'] ; ?></td>
                    <td><?php echo $statistics_data['COUNT(*)'] ; ?></td>
                    <td>$<?php echo $pub_earn_res['publisher_earn_sum'] ; ?></td>
                </tr>
                <?php } ?>
                           
                    </tbody></table>
    </div>
    </div>
    </div>             
    <div class="card shadow mb-4">
                                <div class="card-header py-3">
      
        <h5 class="box-title"> <i class="fa fa-hand-pointer-o"></i> IPs</h5>

        <div class="box-body" style="height: 300px; overflow: auto;">
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>IP</th>
                <th>Count</th>
                <th>Publisher Earnings</th>
            </tr>
            </thead>
                            <tbody>
                         <?php while($ips_data = mysqli_fetch_array($ips_query)) {
                             
                             $ip = $ips_data['ip'];
                             $pub_earn1_sql = "SELECT SUM(publisher_earn) AS publisher_earn1_sum FROM statistics  WHERE user_id ='$user_id' AND created <= '$created' AND ip = '$ip'";
                             $pub_earn1_query = mysqli_query($con,$pub_earn1_sql);
                             $pub_earn1_res = mysqli_fetch_array($pub_earn1_query);

                             
                             ?>
                            <tr>
                    <td><?php echo $ips_data['ip'];  ?></td>
                    <td><?php echo $ips_data['COUNT(*)'] ; ?></td>
                    <td>$<?php echo $pub_earn1_res['publisher_earn1_sum'] ; ?></td>
                </tr>
     <?php }  ?>
                           
                    </tbody></table>
    </div>
    </div>
    </div>       
    
    <div class="card shadow mb-4">
                                <div class="card-header py-3">
      
        <h5 class="box-title"> <i class="fa fa-hand-pointer-o"></i> Referrers</h5>

        <div class="box-body" style="height: 300px; overflow: auto;">
        <br>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Domain</th>
                <th>Count</th>
                <th>Publisher Earnings</th>
            </tr>
            </thead>
                            <tbody>
                      <?php while($refer_data = mysqli_fetch_array($refer_query)) { 
                             $refer = $refer_data['referer_domain'];
                             $pub_earn2_sql = "SELECT SUM(publisher_earn) AS publisher_earn2_sum FROM statistics  WHERE user_id ='$user_id' AND created <= '$created' AND referer_domain = '$refer'";
                             $pub_earn2_query = mysqli_query($con,$pub_earn2_sql);
                             $pub_earn2_res = mysqli_fetch_array($pub_earn2_query);
                          
                          
                          ?>
                            <tr>
                    <td><?php echo $refer_data['referer_domain']  ;?></td>
                    <td><?php echo $refer_data['COUNT(*)'] ; ?></td>
                    <td>$<?php echo $pub_earn2_res['publisher_earn2_sum'] ; ?></td>
                </tr>
                <?php }  ?>
                           
                    </tbody></table>
    </div>
    </div>
    </div>              
    
    

                    </div>
                 </div>
              </div>
           </div>
           
        </div>


</div>
<!-- /.container-fluid -->

</div>


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