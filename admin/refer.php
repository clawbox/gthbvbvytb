<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include 'controllers/withdraws.php';
$username = $_SESSION['adusername']  ;
$pi = "Refered";

include 'header.php';
include 'controllers/refer.php';

?>
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Refered</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Refered By</th>
                       
                       
                    </tr>
                </thead>
              
                <tbody>
                  <?php

$pe_sql=mysqli_query($con,"SELECT * FROM `users` ");
                                     
$record = mysqli_num_rows($pe_sql);
$pagi = ceil($record/$per_page);

while($refer_data =  mysqli_fetch_array($refer_res)) {

    $refer = $refer_data['referred_by'];
    if($refer == 0) {  } else { 


        $sql = "SELECT * FROM `users` WHERE id = '$refer'";
        $res = mysqli_query($con,$sql);
        $data = mysqli_fetch_array($res);


?>
                    <tr>
                       
                        <td><a href="view.php?id=<?php echo $refer_data['id'];?>"><?php echo $refer_data['username']; ?></a></td>
                     
                        <td><a href="view.php?id=<?php echo $data['id'];?>"><?php echo $data['username'];?></a></td>
                        
                    </tr>
                 <?php }    } ?>
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