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


include 'header.php';
?>
  <!-- Main Content -->
  <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-eye"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Views                    </h4>
                  </div>
                  <div class="card-body">
                  <?php echo $monthly_get_data ; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-money-bill-alt	"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Revenue                    </h4>
                  </div>
                  <div class="card-body">
                   $ <?php echo round($monthly_rate,4);  ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-users	"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Referral Revenue
                    </h4>
                  </div>
                  <div class="card-body">
                    $ <?php echo round($refer_monthly_rate,4) ; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-money-bill-alt	"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Avarage CPM
                    </h4>
                  </div>
                  <div class="card-body">
                   $ <?php echo round($monthly_cpm,2); ?>
                  </div>
                </div>
              </div>
            </div>                  
          </div>
          <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    
                                    <div class="card-header">
                                            <h4 class="mb-1">Full Report                                            </h4>
                                           
                                        </div>
                                        
                                        <div class="card-body">
                                        <div class="table-responsive">
                                        <table class="table">
                                        <thead>
<tr>
                                          <th>Date</th>
                                       
                                          <th>Views</th>
                                          <th>Earing</th>
                                          <th>Referral Earnings</th>
                                          <th>CPM</th>
										
                                       </tr>
</thead>
<tbody class="table-border-bottom-0">
<?php
                                    $month = date('n'); // Current month (1-12)
                                    $year = date('Y'); // Current year
                                    
                                    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                    $totalDays = $totalDays-1;
                                      while($i<$totalDays) {
    $allday_date = $list[$i+1] . " 00:00:00" ;
    $showdate = $list[$i+1];
    $todate = $list[$i+1] . " 23:59:59";
 
$daliy_allday_sql = "SELECT * FROM  statistics WHERE created >= '$allday_date' AND created <= '$todate' AND user_id='$user_id'";
$qure = mysqli_query($con,$daliy_allday_sql);
$numrow = mysqli_num_rows($qure);
$res = mysqli_fetch_array($qure);
$total_earing = mysqli_query($con, "SELECT SUM(publisher_earn) AS publisher_earn_sum2 FROM statistics WHERE created >= '$allday_date' AND created <= '$todate' AND user_id='$user_id' ");
$res_earing  = mysqli_fetch_array($total_earing);
$earing_rate = "0.0000";
if($res_earing['publisher_earn_sum2'] >0) {
         
  $earing_rate = $res_earing['publisher_earn_sum2'];
}

$refer_earn_all  = mysqli_query($con, "SELECT SUM(referral_earn) AS referral_earn_sum2 FROM statistics WHERE created >= '$allday_date' AND created <= '$todate' AND referral_id='$user_id' ");
$refer_res_earing  = mysqli_fetch_array($refer_earn_all);
$refer_earing_rate_all = "0.0000";
if($refer_res_earing['referral_earn_sum2'] >0) {
         
  $refer_earing_rate_all = $refer_res_earing['referral_earn_sum2'];
}


$showcpm ='0.0000';
if($numrow >0) {
  $all_getcpm = $earing_rate/$numrow * "1000";


  $showcpm = $all_getcpm. ".0000";   

}   
?>
                                       <tr>
                                          <td><?php echo $showdate ;  ?></td>
                                       
                                          <td><?php echo $numrow ;  ?></td>
                                          <td>$<?php echo $earing_rate;  ?></td>
                                          <td>$<?php echo $refer_earing_rate_all;  ?></td>
                                          <td>$<?php echo $showcpm ;  ?></td>
										
                                       </tr>
                                    
<?php
$i++;



  } 


?>

</tbody>
</table>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div> 
                </div> 
                </div> 
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card ">
                            <div class="card-header">
                               Bot API  </div>
                               <div class ="card-body">
                                <div class="form-group">

<input id="api" type="text"  class="form-control" placeholder="<?php  echo $maindata['api_key'];?>" value="<?php  echo $maindata['api_key'];?>" disabled="">



</div>
                            </div>
            </div>
        </div> <!-- End::app-content -->
       </div>
        </div>
 
        </section>
      </div>

               
<?php
include 'footer.php';

?>



