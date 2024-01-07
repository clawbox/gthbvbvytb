<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Withdraws Method";
include 'header.php';
include 'controllers/withdraws_method.php';



?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add new withdraw method </h1>
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

                    <form method ="POST">
               
    <label  class="form-label">Name</label>
    <input type="txt" class="form-control form-control-user" required="required"  name ="name">
  
    <br>
 
    <label class="form-label">Minimum Withdrawal Amount</label>
    <input type="txt" class="form-control" required="required" name = "amount" >
   
    <br>

 
  <button type="submit" class="btn btn-primary">Add</button>
</form>

                <!-- /.container-fluid -->
<br>
<br>
           

            <h1 class="h3 mb-4 text-gray-800">Withdraw Methods</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Minimum Withdrawal Amount</th>
                      
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
                      
                        <td><?php  echo  $list_data['amount'];  ?></td>
                        <td><a href="editmethod.php?id=<?php  echo  $list_data['id'];  ?>" class="btn btn-info btn-icon-split">
                                       
                                        <span class="text">Edit</span>
                                    </a>
                                    <form method ="POST">
                                    <input type="hidden" name="id" value="<?php  echo  $list_data['id'];  ?>">
                                    <button type="submit" class="btn btn-danger btn-icon-split" ><span class="text">Delete</span></button>
                                  
                                    </form>
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