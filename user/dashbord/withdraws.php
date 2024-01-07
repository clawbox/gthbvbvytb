<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/withdraws.php";

$pi = "Withdraws";
$act = "withdraws";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }
// withdraw

$withdraw_sql = "Select * from settings where id = 15";
$withdrawe_query = mysqli_query($con,$withdraw_sql);
$withdraw_data = mysqli_fetch_array($withdrawe_query);
$withdraw = $withdraw_data['value'];

include 'header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="main-content" style="min-height: 816px;">
        <section class="section">
          <div class="section-header">
            <h1>Withdraw</h1>
          
          </div>     
<?php  if($errore) { ?>
<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle"></i> <?php echo $withmsg; ?></div>
<?php } if($successs) { ?>
<div class="alert alert-success" role="alert"><i class="fa fa-exclamation-triangle"></i>  <?php echo $withmsg2; ?></div>
<?php } ?>
<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="fas fa-money-bill-alt	"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Available Balance
                   </h4>
                  </div>
                  <div class="card-body">
                  $ <?php echo round($Balance,4); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-clock"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pending Withdrawn                   </h4>
                  </div>
                  <div class="card-body">
                   $ <?php echo round($pending,4); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                <i class="fas fa-money-bill-alt	"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Withdraw
                    </h4>
                  </div>
                  <div class="card-body">
                    $ <?php echo round($total,4); ?>
                  </div>
                </div>
              </div>
            </div>
                          
          </div>

 
<div class="card">
<br>
<?php if($withdraw == 1) { ?>
<form class="form-horizontal" role="form" method="post">
<center><button name="publisher_earnings" type="submit" class="btn mb-1 btn-rounded btn-primary" >Withdraws</button></center></form>
<?php
}
?>
<h5 class="card-header">Your Withdraws</h5>
<div class="table-responsive text-nowrap">
<table class="table">
<caption class="ms-4">
<ul class="pagination">
</ul>
</caption>
<thead>
<tr>
<th><a class="desc" >ID</a></th>
<th><a >Date</a></th>
<th>Status</th>

<th>Publisher Earnings</th>
                                            <th>Referral Earnings</th>
                                        <th>Total Amount</th>
<th>Withdrawal Method</th>
<th>Withdrawal Account</th>
</tr></thead>
<tbody>
<?php   while($history_res = mysqli_fetch_array($history_query)) {?>
<tr>
                                          <td><?php echo $history_res['id'];  ?></td>
                                          <td><?php echo $history_res['created'];  ?></td>
                                          <td><?php if($history_res['status'] == "1") { echo  "Approved";}  
                                                    if($history_res['status'] == "2") { echo  "Pending";} 
                                                    if($history_res['status'] == "3") { echo  "Complete";} 
                                                    if($history_res['status'] == "4") { echo  "Cancelled";} 
                                                    if($history_res['status'] == "5") { echo  "Returned";} 
                                          ?></td>
                                          <td><?php echo $history_res['publisher_earnings'];  ?></td>
                                          <td><?php echo $history_res['referral_earnings'];  ?></td>
                                          <td><?php echo $history_res['amount'];  ?></td>
                                          <td><?php echo $history_res['method'];  ?></td>
                                          <td><?php  echo $history_res['account'];  ?></td>
                                     
</tr>
<?php  } ?>  
</tbody>
</table>
</div>
</div>
<br>
<div class="card mb-4">
<div class="card-body">
<ul class="list-group list-group-flush">
<li>Pending: The payment is being checked by our team.</li>
<li>Approved: The payment has been approved and is waiting to be sent.</li>
<li>Complete: The payment has been successfully sent to your payment account.</li>
<li>Cancelled: The payment has been cancelled.</li>
<li>Returned: The payment has been returned to your account.</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
include 'footer.php';

?>
