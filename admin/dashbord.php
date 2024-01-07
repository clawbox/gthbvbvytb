<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Dashbord";
include 'header.php';
include 'controllers/dashbord.php';


?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                <center><h2>This Month Report</h2></center>
                <br>

                    <!-- Content Row -->
                    <div class="row">
             
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_user;  ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Publisher Earnings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $monthly_rate;   ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">

                                
                                <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Referral Earnings</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$<?php echo $refer_monthly_rate;  ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total View</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthly_get_data;  ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa fa-bar-chart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                    <div class="table-responsive" style="height: 300px;overflow: auto;">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <th>Date</th>
                                       
                                          <th>Views</th>
                                          <th>Earing</th>
                                          <th>CPM</th>
										
                                       </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     $error = "";
                                     $daliy_allday_sql = "";
                                       $i ="-1";
                                       $showdate = "";
                                       $todate = "";
                                       $allday_date= "";
                                       $list=array();
                                     for($d=1; $d<=31; $d++)
                                     {
                                         $time=mktime(12, 0, 0, date('m'), $d, date('Y'));
                                         if (date('m', $time)==date('m'))
                                             $list[]=date('Y-m-d', $time);
                                     }
                                         
                                     $month = date('n'); // Current month (1-12)
                                     $year = date('Y'); // Current year
                                     
                                     $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                     $totalDays = $totalDays-1;
                                       while($i<$totalDays) {
    $allday_date = $list[$i+1] . " 00:00:00" ;
    $showdate = $list[$i+1];
    $todate = $list[$i+1] . " 23:59:59";
 
$daliy_allday_sql = "SELECT * FROM  statistics WHERE created >= '$allday_date' AND created <= '$todate' ";
$qure = mysqli_query($con,$daliy_allday_sql);
$numrow = mysqli_num_rows($qure);
$res = mysqli_fetch_array($qure);
$total_earing = mysqli_query($con, "SELECT SUM(publisher_earn) AS publisher_earn_sum2 FROM statistics WHERE created >= '$allday_date' AND created <= '$todate'  ");
$res_earing  = mysqli_fetch_array($total_earing);
$earing_rate = "0.0000";
if($res_earing['publisher_earn_sum2'] >0) {
         
  $earing_rate = $res_earing['publisher_earn_sum2'];
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
                                          <td><?php echo $earing_rate;  ?></td>
                                          <td><?php echo $showcpm ;  ?></td>
										
                                       </tr>
                                    
<?php
$i++;



  } 


?>
                       
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
            <?php include 'footer.php';  ?>
