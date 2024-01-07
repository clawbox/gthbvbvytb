<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include 'controllers/withdraws.php';
$username = $_SESSION['adusername']  ;
$pi = "Withdraws";

include 'header.php';



include 'controllers/withdraws.php';


?>
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Withdraws</h1>

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
                          <form method="post" >
      
      <div class="form-group text "><input type="text"  name="filter" class="form-control" size="0" placeholder="User Id" ><span class="help-block"></span></div>
    
     
            <div class="form-group text "><select name="status" class="form-control"
                    id="conditions-status">
                    <option value="7">Status</option>
                    <option value="1">Approved</option>
                    <option value="2">Pending</option>
                    <option value="3">Complete</option>
                    <option value="4">Cancelled</option>
                    <option value="5">Returned</option>
                </select><span class="help-block"></span></div>
        </div>
   
     
      <button class="btn btn-info btn-icon-split" type="submit"><span class="text">Filter</span></button>
</form>

<?php if(isset($_POST['filter'])) { ?>
    <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Publisher Earnings</th>
                                            <th>Referral Earnings</th>
                                            <th>Total Amount</th>
                                            <th>Withdrawal Method</th>
                                            <th> Withdrawal Account</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <?php
                                         $filtervalue = $_POST['filter'];
                                        $status = $_POST['status'];
                                        if(empty($filtervalue))  {

                                            $sub_sql = "status ='$status' ";
                                            
                                                                              }elseif($status == 7) {
                                                                                $sub_sql = " user_id ='$filtervalue'  ";
                                            
                                            
                                            
                                                                              }else {
                                            
                                            
                                                                                $sub_sql = "status ='$status' AND user_id ='$filtervalue'  ";
                                            
                                                                              }
                                 $pe_sql=mysqli_query($con,"SELECT * FROM `withdraws` WHERE  $sub_sql ORDER BY id DESC LIMIT $start, $per_page ");
                                 $query2 = mysqli_query($con,"SELECT * FROM `withdraws` WHERE $sub_sql ORDER BY id DESC ");
                                     
                                 $record = mysqli_num_rows($pe_sql);
                                 $pagi = ceil($record/$per_page);


                                        while($resss = mysqli_fetch_array($query2)) {

                                            $user_id = $resss['user_id'];
                                            $user_sql = "SELECT * FROM `users` WHERE id = '$user_id'";
                                            $user_query = mysqli_query($con,$user_sql);
                                            $user_res = mysqli_fetch_array($user_query);
                                            $username = $user_res['username'];
                                            $stat = $resss['status'];
                                         if($stat == "1") {

                                              $status = "Approved"; 





                                         }
                                         if($stat == "2") {

                                            $status = "Pending"; 





                                       }

                                       if($stat == "3") {

                                        $status = "Complete"; 





                                   }

                                   if($stat == "4") {

                                    $status = "Cancelled"; 





                               }

                               if($stat == "5") {

                                $status = "Returned"; 





                           }



                                 


                                        ?>
                                        <tr>
                                            <th><?php echo $resss['id'] ; ?></th>
                                            <th><a href="view.php?id=<?php echo $user_id ;?>" target="_blank"><?php echo $username ; ?></a></th>
                                            <th><?php echo $resss['created'] ; ?></th>
                                            <th><?php echo $status; ?></th>
                                            <th>$<?php echo $resss['publisher_earnings'] ; ?></th>
                                            <th>$<?php echo $resss['referral_earnings'] ; ?></th>
                                            <th>$<?php echo $resss['amount'] ; ?></th>
                                            <th><?php echo $resss['method'] ; ?></th>
                                            <th><?php echo $resss['account'];  ?></th>
                                            <th>
                                            <div class="card-body">
                                                <?php  if($stat == "2") { ?>
                                            <a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
                                      
                                        <span class="text">View </span>
                                    </a>
                                    <form method ="POST">

                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="appid" value="<?php echo $resss['id'] ;?>">     
                                    
                                    <button type="submit" class="btn btn-success btn-icon-split"> <span class="text">Approve</span></button>
                                   
                                       

                                    </form>
                                    <form method ="POST">
                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="cancelid" value="<?php echo $resss['id'] ;?>"> 
                                    <button type="submit" class="btn btn-danger btn-icon-split" > <span class="text">Cancel</span></button>
                                    </form>
                                   


                                 <?php 
                                                }
                                     
                                                if($stat == "1") { 

                                    
                                        ?>
                                       
                                       <a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
                                      
                                        <span class="text">View </span>
                                    </a>
                                    <form method ="POST">

                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="campleteid" value="<?php echo $resss['id'] ;?>"> 

                                    <button type="submit" class="btn btn-success btn-icon-split" >  <span class="text">Complete</span></button>
                                    
                                    </form>
                                    <form method ="POST">
                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="cancelid" value="<?php echo $resss['id'] ;?>"> 
                                   <button type="submit" class="btn btn-danger btn-icon-split" > <span class="text">Cancel</span></button>
                                   </form>
                                 

                                 <?php  } if($stat == "3") {   ?>

                                 <a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
                                      
                                      <span class="text">View </span>
                                  </a>
                                  

                               <?php }   if($stat == "4") {   ?>

<a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
     
     <span class="text">View </span>
 </a>
 

<?php }  if($stat == "5") {   ?>

<a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
     
     <span class="text">View </span>
 </a>
 

<?php }  ?>

  

             </div></th>
                                        </tr>

                                        <?php  }  
                            
                                        
                                        ?>
                                    </tfoot>

             </table>

                         
                       <br>
                       
                       <ul class="pagination">
                                   <?php
                                   
                                   for($i=1;$i<=$pagi;$i++) { 

                                    $class = "";
                                      if($current_page == $i) {

                                       $class = "active";


                                      }
                                      
                                      ?>
                                   <li class="paginate_button page-item <?php echo $class;  ?>">
                                      <a href="?page=<?php echo $i;   ?>"  class="page-link"><?php echo $i;  ?></a>
                                    </li>

                                    <?php  }  ?>
                                 </ul>

    <?php  } else{ ?>
                          <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Publisher Earnings</th>
                                            <th>Referral Earnings</th>
                                            <th>Total Amount</th>
                                            <th>Withdrawal Method</th>
                                            <th> Withdrawal Account</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <?php
                                 $pe_sql=mysqli_query($con,"SELECT * FROM `withdraws` ORDER BY id DESC LIMIT $start, $per_page");
                                     
                                 $record = mysqli_num_rows($pe_sql);
                                 $pagi = ceil($record/$per_page);


                                        while($resss = mysqli_fetch_array($query)) {

                                            $user_id = $resss['user_id'];
                                            $user_sql = "SELECT * FROM `users` WHERE id = '$user_id'";
                                            $user_query = mysqli_query($con,$user_sql);
                                            $user_res = mysqli_fetch_array($user_query);
                                            $username = $user_res['username'];
                                            $stat = $resss['status'];
                                         if($stat == "1") {

                                              $status = "Approved"; 





                                         }
                                         if($stat == "2") {

                                            $status = "Pending"; 





                                       }

                                       if($stat == "3") {

                                        $status = "Complete"; 





                                   }

                                   if($stat == "4") {

                                    $status = "Cancelled"; 





                               }

                               if($stat == "5") {

                                $status = "Returned"; 





                           }



                                 


                                        ?>
                                        <tr>
                                            <th><?php echo $resss['id'] ; ?></th>
                                            <th><a href="view.php?id=<?php echo $user_id ;?>" target="_blank"><?php echo $username ; ?></a></th>
                                            <th><?php echo $resss['created'] ; ?></th>
                                            <th><?php echo $status; ?></th>
                                            <th>$<?php echo $resss['publisher_earnings'] ; ?></th>
                                            <th>$<?php echo $resss['referral_earnings'] ; ?></th>
                                            <th>$<?php echo $resss['amount'] ; ?></th>
                                            <th><?php echo $resss['method'] ; ?></th>
                                            <th><?php if($resss['method'] == "bank") {
                                               $bank_sql = "SELECT * FROM `user_bank` WHERE user_id = '$user_id'";
                                               $bank_query = mysqli_query($con,$bank_sql);
                                               $bank_numz = mysqli_num_rows($bank_query);
                                               if($bank_numz == 1) {
                                               $bank_data = mysqli_fetch_array($bank_query);
                                               $bank_name = $bank_data['name'];
                                               $bank_number = $bank_data['number'];
                                               $bank_ifsc = $bank_data['IFSC'];
                                               
                                               
                                               }else {
                                               
                                                   $bank_name = "";
                                                   $bank_number ="";
                                                   $bank_ifsc = "";
                                               
                                               
                                               }
                                                
                                                echo "Account Holder Name: $bank_name,Account Number:$bank_number,IFSC code:$bank_ifsc";  }else { echo $resss['account']; } ?></th>
                                            <th>
                                            <div class="card-body">
                                                <?php  if($stat == "2") { ?>
                                            <a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
                                      
                                        <span class="text">View </span>
                                    </a>
                                    <form method ="POST">

                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="appid" value="<?php echo $resss['id'] ;?>">     
                                    
                                    <button type="submit" class="btn btn-success btn-icon-split"> <span class="text">Approve</span></button>
                                   
                                       

                                    </form>
                                    <form method ="POST">
                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="cancelid" value="<?php echo $resss['id'] ;?>"> 
                                    <button type="submit" class="btn btn-danger btn-icon-split" > <span class="text">Cancel</span></button>
                                    </form>
                                   


                                 <?php 
                                                }
                                     
                                                if($stat == "1") { 

                                    
                                        ?>
                                       
                                       <a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
                                      
                                        <span class="text">View </span>
                                    </a>
                                    <form method ="POST">

                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="campleteid" value="<?php echo $resss['id'] ;?>"> 

                                    <button type="submit" class="btn btn-success btn-icon-split" >  <span class="text">Complete</span></button>
                                    
                                    </form>
                                    <form method ="POST">
                                    <input type="hidden" name="userid" value="<?php echo $user_id ;?>">
                                    <input type="hidden" name="cancelid" value="<?php echo $resss['id'] ;?>"> 
                                   <button type="submit" class="btn btn-danger btn-icon-split" > <span class="text">Cancel</span></button>
                                   </form>
                                 

                                 <?php  } if($stat == "3") {   ?>

                                 <a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
                                      
                                      <span class="text">View </span>
                                  </a>
                                  

                               <?php }   if($stat == "4") {   ?>

<a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
     
     <span class="text">View </span>
 </a>
 

<?php }  if($stat == "5") {   ?>

<a href="chacking.php?id=<?php echo $resss['id'];   ?>" class="btn btn-primary btn-icon-split">
     
     <span class="text">View </span>
 </a>
 

<?php }  ?>

  

             </div></th>
                                        </tr>

                                        <?php  }  
                            
                                        
                                        ?>
                                    </tfoot>

             </table>

                         
                       <br>
                       
                       <ul class="pagination">
                                   <?php
                                   
                                   for($i=1;$i<=$pagi;$i++) { 

                                    $class = "";
                                      if($current_page == $i) {

                                       $class = "active";


                                      }
                                      
                                      ?>
                                   <li class="paginate_button page-item <?php echo $class;  ?>">
                                      <a href="?page=<?php echo $i;   ?>"  class="page-link"><?php echo $i;  ?></a>
                                    </li>

                                    <?php  }  ?>
                                 </ul>
                                 <?php  } ?>
                    </div>
                 </div>
              </div>
           </div>
           
        </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->



<?php  include 'footer.php';  ?>