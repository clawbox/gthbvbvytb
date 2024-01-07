<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";

$pi = "Referrals";
$act = "refer";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }


include 'header.php';
?>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
          <div class="section-header">
            <h1>Refer And Earn</h1>
          
          </div>
          <div class="card">
            <div class="card-body">
              
           
The <?php echo $name;  ?> referral program is a great way to spread the word of this great service and to earn even more money with your short links! Refer friends and receive <?php echo $refer  ?>% of their earnings for life!        </p>

   
     <div class="form-group">
                     
                      <input type="text" class="form-control" disabled value="https://<?php echo $main_domain; ?>/aff.php?aff=<?php echo $user_id;  ?>">
                    </div>  



   
<div class="row">
               <div class="col-md-12">
                  <div class="panel panel-default">
                     
                     <div class="panel-body">
                        <div class="row">
                           <div class="col-md-12 col-sm-12 col-xs-12">
                          <h5> My Referrals</h5>
                          <br>

                          <div class="table-responsive">
                          <table class="table">
  <thead>
    <tr>
    <th> Username</th>
                                       
    </tr>
  </thead>
  <tbody>
                                   
                                      
                                   

  <?php   
                                      
                                      while($refer_res = mysqli_fetch_array($refers_query)) {


                                        ?>

<tr>
                                          <td><?php echo $refer_res['username']  ;?></td>
                                       
                                    
										
                                     
                                        <?php
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
            
         </div>
   

</div>
</div>


<div class="content-backdrop fade"></div>
</div>

<?php
include 'footer.php';

?>
