<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";

$username = $_SESSION['adusername']  ;
$pi = "Reports";

include 'header.php';
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
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Reports</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  
    <div class="card-body">
    
<br>
<br>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>File Link</th>
                        <th>Message</th>
                        <th>Created</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
              
                <tbody>
                    <?php 
                       $pe_sql=mysqli_query($con,"SELECT * FROM `reports` ORDER BY id DESC limit $start,$per_page ");
                                     
                       $record = mysqli_num_rows($pe_sql);
                       $pagi = ceil($record/$per_page);



                    while($report_data = mysqli_fetch_array($pe_sql)) {
                        $user_id = $report_data['user_id'];
                        $user_sql = "SELECT * FROM `users` WHERE id = '$user_id'";
                        $user_query = mysqli_query($con,$user_sql);
                        $user_res = mysqli_fetch_array($user_query);
                        $username = $user_res['username'];
                        $file_id = $report_data['file_id'];
                        $file_sql = "SELECT * FROM `files` WHERE `id` = '$file_id'";
                        $file_query = mysqli_query($con,$file_sql);
                        $file_data = mysqli_fetch_array($file_query);
                        $file_name = $file_data['file_name'];
                        $file_link = $file_data['alies'];
                    ?>
                    <tr>
                        <td><?php echo $report_data['id']; ?></td>
                        <td><?php echo $report_data['name']; ?></td>
                        <td><?php echo $report_data['email']; ?></td>
                        <td><?php echo $report_data['status']; ?></td>
                        <td><a href="/<?php echo $file_link ;?>" target="_blank"><?php echo $file_name ; ?></a></td>
                        <td><?php echo $report_data['message']; ?></td>
                        <td><?php echo $report_data['created']; ?></td>
                        <td><a href="delete_report.php?id=<?php echo $report_data['id']; ?>" class="btn btn-danger btn-icon-split">
                                       
                                        <span class="text">Delete Report</span>
                                    </a>
                                <?php 
                                if($report_data['status'] == "pending") {
                                ?>
                                <a href="delete_file.php?id=<?php echo $file_id; ?>&report=<?php echo $report_data['id']; ?>" class="btn btn-danger btn-icon-split">
                                       
                                       <span class="text">Delete File</span>
                                   </a>
                            <?php
                                }
                            ?>
                            </td>
                    </tr>
                   <?php  }?>
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
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php  include 'footer.php';  ?>