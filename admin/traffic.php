<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";

$username = $_SESSION['adusername']  ;
$pi = "Traffic Chacker";

include 'header.php';
include 'controllers/traffic.php';

?>
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Traffic Chacker</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  
                    <tr>
                        <th>Id</th>
                        <th>Created</th>
                        <th>User</th>
                        <th>IP</th>
                        <th>Referer Domain</th>
                     
                       
                    </tr>

                 
                </thead>
              
                <tbody>
                <?php
                 $pe_sql=mysqli_query($con,"select * from statistics ORDER BY id DESC ");
                                     
                 $record = mysqli_num_rows($pe_sql);
                 $pagi = ceil($record/$per_page);


while($data = mysqli_fetch_array($res))
{
$user_id = $data['user_id'];
$user_sql = "SELECT * FROM `users` WHERE id = '$user_id'";
$user_res = mysqli_query($con,$user_sql);
$user_data = mysqli_fetch_array($user_res);
$username = $user_data['username'];

?>
                    <tr>
                        <td><?php echo $data['id'];  ?></td>
                        <td><?php echo $data['created'];  ?></td>
                        <td><a href="view.php?id=<?php echo $user_id;?>"><?php echo $username  ?></a></td>
                        <td><?php echo $data['ip'];  ?></td>
                        <td><?php echo $data['referer_domain'];  ?></td>
                        
                       
                    </tr>
                    
                    <?php  } ?>
                </tbody>
            </table>
            
            <ul class="pagination">
                  <li class="paginate_button page-item <?php if($current_page == 1) { echo "disabled";} ?>"><a class="page-link" href="?page=<?php echo $current_page -1; ?>">Previous</a></li> 
                                    <?php for($i=1;$i<=$pagi;$i ++) { ?> 
<?php 
if($i <10) { 
?> 
<li class="paginate_button page-item <?php if($current_page == $i) {  echo "active"; } ?>"><a class="page-link "  href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li> 
                                   

                                    
  <?php 
}else { ?> 
 
<?php 
                 }                 } 
  ?> 
                                     <li class="paginate_button page-item <?php if($current_page == $pagi) { echo "disabled";} ?>"><a class="page-link " href="?page=<?php echo $current_page +1; ?>">Next</a></li> 
                                 </ul>
        </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php  include 'footer.php';  ?>