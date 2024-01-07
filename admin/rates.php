<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Rates";
include 'header.php';
include 'controllers/rate.php';

$succ = false;

?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Payout Rate Settings </h1>
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
             <?php
             while($data = mysqli_fetch_array($query)) {
             ?>
    <label  class="form-label"><?php echo $data['code'] ?></label>
    <input type="txt" class="form-control form-control-user" value = "<?php echo $data['value'] ?>" name ="<?php echo $data['code'] ?>">
  
    <br>
    <?php
             }
    ?>
 <br>
  <button type="submit" class="btn btn-primary">Save</button>
</form>


                </div>
                <!-- /.container-fluid -->
<br>
<br>
            </div>
            <!-- End of Main Content -->

            <?php include 'footer.php';  ?>

          