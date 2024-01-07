<?php







// Main Code 
session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "All Links ";

include 'header.php';
include 'controllers/dashbord.php';

$start = 0;
$per_page = 10;
$current_page = 1;
if(isset($_GET['page'])) {


$start = $_GET['page'];
$current_page = $start;
$start --;
$start = $start*$per_page;



}



?>
       <!-- Begin Page Content -->
       <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Links </h1>


        <!-- Page Content Start -->
        <!-- ================== -->
        <div class="wraper container-fluid">
           <div class="page-title">
           
   
           </div>
           <div class="row">
              <div class="col-md-12">
                 <div class="panel panel-default">
                    
                    <div class="panel-body">
                       <div class="row">
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="box-body">
        <form method="post" >
      
        <div class="form-group text "><input type="text" name="filter" class="form-control" size="0" placeholder="User Id" ><span class="help-block"></span></div>
       <br>
       <div class="form-group text "><input type="text" name="alies" class="form-control" size="0" placeholder="File alies" ><span class="help-block"></span></div>
       
        <button class="btn btn-info btn-icon-split" type="submit"><span class="text">Filter</span></button>
        </form>
      <br>
      <br>
      <?php if(isset($_POST['filter'])) { ?>
        
         <div class="table-responsive">
                           
                           <table class="table">
                              <thead>
                                 <tr>
                                
                                 
                                 <th>File Name</th>
                                         <th>Username</th>
                                         <th>Created</th>
                                         <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  $filervalue = $_POST['filter'];
                                  $alies = $_POST['alies'];
                                  if(empty($filervalue))  {

$sub_sql = "alies ='$alies' ";

                                  }elseif(empty($alies)) {
                                    $sub_sql = " user_id ='$filervalue'  ";



                                  }else {


                                    $sub_sql = "alies ='$alies' AND user_id ='$filervalue'  ";

                                  }
                                  $sql = mysqli_query($con, "SELECT * FROM files WHERE $sub_sql ORDER BY id DESC LIMIT $start, $per_page");

                                  $pe_sql=mysqli_query($con,"SELECT * FROM files WHERE $sub_sql ");
                                
                                  $record = mysqli_num_rows($pe_sql);
                                  $pagi = ceil($record/$per_page);


                                  while($row=mysqli_fetch_assoc($sql)){

$user_id = $row['user_id'];
$sqli = "SELECT * FROM `users` WHERE id = '$user_id'";
$qur = mysqli_query($con,$sqli);
$res = mysqli_fetch_assoc($qur);
$username = $res['username'];
// $numrow = mysqli_num_rows($sql);
// $page = $numrow/10;


                                  ?>
                                <tr>
                                       
                                      
                                       <td><a href="/<?php echo $row['alies']?>" target="_blank"><?php echo $row['file_name']?> </a></td>
                                       <td><a href="view.php?id=<?php echo $row['user_id']?>" target="_blank"><?php echo $username; ?></a></td>
                                       <td><?php echo $row['created']?></td>
                                       <td>
                                       <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-success btn-circle btn-sm" ><i class="fas fa-edit"></i></a>  </td>
                                       <td>
                            
<a href="?id=<?php echo $row['id']?>&type=delete" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                              </td>
                                       
                                    </tr>
                                 <?php } ?>
                                 
                              </tbody>
                           </table>
                     
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
                             <div class="table-responsive">
                           
                                <table class="table">
                                   <thead>
                                      <tr>
                                     
                                      
                                         <th>File Name</th>
                                         <th>Username</th>
                                         <th>Created</th>
                                         <th></th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                       <?php
                                      
                                       $sql=mysqli_query($con,"select * from files ORDER BY id DESC limit  $start,$per_page ");
                                       $pe_sql=mysqli_query($con,"select * from files ");
                                     
                                       $record = mysqli_num_rows($pe_sql);
                                       $pagi = ceil($record/$per_page);


                                       while($row=mysqli_fetch_assoc($sql)){

$user_id = $row['user_id'];
$sqli = "SELECT * FROM `users` WHERE id = '$user_id'";
$qur = mysqli_query($con,$sqli);
$res = mysqli_fetch_assoc($qur);
$username = $res['username'];
// $numrow = mysqli_num_rows($sql);
// $page = $numrow/10;


                                       ?>
                                      <tr>
                                       
                                      
                                         <td><a href="/<?php echo $row['alies']?>" target="_blank"><?php echo $row['file_name']?> </a></td>
                                         <td><a href="view.php?id=<?php echo $row['user_id']?>" target="_blank"><?php echo $username; ?></a></td>
                                         <td><?php echo $row['created']?></td>
                                         <td>
                                         <a href="edit.php?id=<?php echo $row['id']?>" class="btn btn-success btn-circle btn-sm" ><i class="fas fa-edit"></i></a>  </td>
                                         <td>
										
<a href="?id=<?php echo $row['id']?>&type=delete" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
										  </td>
                                         
                                      </tr>
                                      <?php } ?>
                                      
                                   </tbody>
                                </table>
                          
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
           </div>
           
        </div>


</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->


<?php include 'footer.php';  ?>
