<?php
$mainten_sql = "Select * from settings where id = 13 ";
$mainten_query = mysqli_query($con,$mainten_sql);
$mainten_data = mysqli_fetch_array($mainten_query);
$site_maintenance = $mainten_data['value'];

if($site_maintenance == 1) {
    
    echo "The site is under maintenance";
    die();
}
 $username =$_SESSION['username'];
 $sql = "Select * from users where username ='$username' ";
 $data =mysqli_query($con,$sql);
 $maindata =mysqli_fetch_array($data);
 $user_id = $maindata['id'];
 $publisher_earnings = $maindata['publisher_earn'];
 $referral_earnings = $maindata['referral_earnings'];
$Balance = $publisher_earnings + $referral_earnings;
$withdrawal_method = $maindata['method'];
$withdrawal_account = $maindata['account'];
$method_sql = "Select * from withdraw_methods ";
$method_query = mysqli_query($con,$method_sql);
$profile_sql =  "Select * from withdraw_methods ";
$profile_query = mysqli_query($con,$profile_sql);

$st_server_sql = "SELECT * FROM `settings` WHERE id = '18'";
$st_server_query = mysqli_query($con,$st_server_sql);
$st_server_data = mysqli_fetch_assoc($st_server_query);
$st_server = $st_server_data['value'];

$msg =  false;

$refers_sql = "Select * from users where referred_by ='$user_id'";
$refers_query = mysqli_query($con,$refers_sql);
$current_month_name = date('F');
$current_year = date('Y');
// Refer Percentage 

$refer_sql = "Select * from settings where id = 6 ";
$refer_query = mysqli_query($con,$refer_sql);
$refer_data = mysqli_fetch_array($refer_query);
$refer = $refer_data['value'];

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
		


		
		 
         $date= date("Y-m-d") ;
         $from = $date. " 00:00:00";
         $to = $date. " 23:59:59";
         $month = date("Y-m-t", strtotime($date));
         $thismonth =  $month. " 23:59:59" ;
         $from_date_month = date("Y-m") ;
         $from_month =  $from_date_month . "-1 23:59:59" ;
         
         
         $daliy_report = "SELECT * FROM  statistics WHERE created >= '$from' AND created <= '$to' AND user_id='$user_id' ";
         $dataf =mysqli_query($con,$daliy_report);
         $testdata =mysqli_num_rows($dataf);
         $totsl_earning_daliy = mysqli_query($con, "SELECT SUM(publisher_earn) AS publisher_earn_sum FROM statistics WHERE created >= '$from' AND created <= '$to' AND user_id='$user_id'");
         $totsl_earning =mysqli_fetch_array($totsl_earning_daliy);
         $refer_earn_daliy = mysqli_query($con,"SELECT SUM(referral_earn) AS referral_earn_sum FROM statistics WHERE created >= '$from' AND created <= '$to' AND referral_id='$user_id'");
         $refer_earn_res = mysqli_fetch_array($refer_earn_daliy);

         $refer_earn_rate = "0.0000";
         if($refer_earn_res['referral_earn_sum'] >0) { 
             
           $refer_earn_rate  = $refer_earn_res['referral_earn_sum'];
            
            
         }
            $rate = "0.0000";
         if($totsl_earning['publisher_earn_sum'] >0) {
         
        $rate = $totsl_earning['publisher_earn_sum'];
    }

    
        $cpm = '0.0000';
        if($testdata >0) {
            $getcpm = $rate/$testdata * "1000";
         $cpm = $getcpm. ".0000";      
        }   

        // Month code 

        $monthly_report = "SELECT * FROM  statistics WHERE created >= '$from_month' AND created <= '$thismonth' AND user_id='$user_id' ";
         $monthly_data =mysqli_query($con,$monthly_report);
         $monthly_get_data =mysqli_num_rows($monthly_data);
         $totsl_earning_monthly = mysqli_query($con, "SELECT SUM(publisher_earn) AS publisher_earn_sum FROM statistics WHERE created >= '$from_month' AND created <= '$thismonth' AND user_id='$user_id'");
         $monthly_totsl_earning =mysqli_fetch_array($totsl_earning_monthly);
         $monthly_rate = "0.0000";
         if($monthly_totsl_earning['publisher_earn_sum'] >0) {
         
        $monthly_rate = $monthly_totsl_earning['publisher_earn_sum'];
    }

    $refer_totsl_earning_monthly = mysqli_query($con, "SELECT SUM(referral_earn) AS referral_earn_sum FROM statistics WHERE created >= '$from_month' AND created <= '$thismonth' AND referral_id='$user_id'");
    $refer_monthly_totsl_earning =mysqli_fetch_array($refer_totsl_earning_monthly);
    $refer_monthly_rate = "0.0000";
    if($refer_monthly_totsl_earning['referral_earn_sum'] >0) {
    
   $refer_monthly_rate = $refer_monthly_totsl_earning['referral_earn_sum'];
}


        $monthly_cpm = '0.0000';
        if($monthly_get_data >0) {
            $monthly_getcpm = $monthly_rate/$monthly_get_data * "1000";
     

            $monthly_cpm = $monthly_getcpm. ".0000";   
        
        }   

        $video_sql = "SELECT * FROM `files` WHERE user_id = '$user_id' ORDER BY id DESC";
       

if(isset($_POST['alias'])) {
    $aliesx = $_POST['alias'];
    $video_sql = "SELECT * FROM `files` WHERE user_id = '$user_id' AND alies ='$aliesx' ORDER BY id DESC ";


}

$video_query = mysqli_query($con,$video_sql);  
