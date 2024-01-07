<?php







// Main Code 
session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "All Plans ";
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
<h1 class="h3 mb-4 text-gray-800">All Plans </h1>


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
                       <a href="addplan.php" ><button class="btn btn-info btn-icon-split"><span class="text"> Add Plan</span></button></a>
                          <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="box-body">

      <br>
   
                             <div class="table-responsive">
                           
                                <table class="table">
                                   <thead>
                                      <tr>
                                     
                                      
                                         <th>Name</th>
                                         
                                         <th></th>
                                      </tr>
                                   </thead>
                                   <tbody>
                                       <?php
                                      
                                       $sql=mysqli_query($con,"select * from plan limit $start,$per_page ");
                                       $pe_sql=mysqli_query($con,"select * from plan ");
                                     
                                       $record = mysqli_num_rows($pe_sql);
                                       $pagi = ceil($record/$per_page);


                                       while($row=mysqli_fetch_assoc($sql)){




                                       ?>
                                      <tr>
                                       
                                      
                                         <td><?php echo $row['name']?> </td>
                                         
                                         <td>
                                         <a href="editplan.php?id=<?php echo $row['id']?>" class="btn btn-success btn-circle btn-sm" ><i class="fas fa-edit"></i></a> 
                                       
										

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
