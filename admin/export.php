<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include 'controllers/withdraws.php';
$username = $_SESSION['adusername']  ;
$pi = "Export";
include 'controllers/export.php';
include 'header.php';






?>
 
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Export </h1>
                    <form method="post" accept-charset="utf-8" >
   
  
   

    <div class="row">
        <div class="col-sm-2">Status</div>
        <div class="col-sm-10">
            <div class="form-group select "><select name="status" class="form-control"
                    id="conditions-status">
                    <option value="">Status</option>
                    <option value="1">Approved</option>
                    <option value="2">Pending</option>
                    <option value="3">Complete</option>
                    <option value="4">Cancelled</option>
                    <option value="5">Returned</option>
                </select><span class="help-block"></span></div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">Withdrawal Method</div>
        <div class="col-sm-10">
            <div class="form-group select "><select name="method" class="form-control"
                    id="conditions-method">
                    <option value="">Withdrawal Method</option>
                    <?php  while($method_res = mysqli_fetch_array($method_query))  {

?>
<option value="<?php  echo $method_res[1];?>"><?php  echo $method_res['name'];?></option> 


<?php
    }?>
                </select><span class="help-block"></span></div>
        </div>
    </div>

    <button class="btn btn-primary" type="submit">Submit</button>
   
</form>

                    </div>

<?php  include 'footer.php';  ?>