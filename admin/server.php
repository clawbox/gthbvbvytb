<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Storage Server";
include 'header.php';
include 'controllers/server.php';



?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                   
                    <?php

if($succ) {
?>
<div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body">
                                <?php echo $massset ;   ?>
                                </div>
                            </div>




<br>
<br>
<?php

}
?>

                 
<a href="addserver.php" class="btn btn-primary">Add</a>



                <!-- /.container-fluid -->
<br>
<br>
           

            <h1 class="h3 mb-4 text-gray-800">Storage Server</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                      
                       
                    </tr>
                </thead>
              
                <tbody>
              <?php  
              
              while($list_data = mysqli_fetch_array($list_res)) {


              ?>
                    <tr>
                        <td><?php  echo  $list_data['id'];  ?></td>
                        <td><?php  echo  $list_data['name'];  ?></td>
                        <td>
                                     
                                  
                            
<a href="?id=<?php echo $list_data['id']?>&type=delete" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                            
</td>
                      
                    </tr>
                <?php    } ?>
                </tbody>
            </table>
         
        </div>
    </div>
</div>
            <!-- End of Main Content -->
            </div>

<?php include 'footer.php';  ?>