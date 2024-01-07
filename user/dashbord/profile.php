<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/profile.php";

$pi = "Profile";
$act = "withdraws";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }


include 'header.php';
?>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
          <div class="section-header">
            <h1>Withdrawal Method</h1>
          
          </div>

          <div class="section-body">
           
            <div class="card">
            <div class="card-body">
           
              
          
<?php if($successs) { ?>
<div class="alert alert-success" role="alert">
<p><?php echo $msg;  ?></p>
</div>
<?php }  ?>
<?php if($erro) { ?>
<div class="alert alert-danger" role="alert">
<p><?php echo $msg;  ?></p>
</div>
<?php }  ?>
<div class="card_title">

<form method="post" accept-charset="utf-8" > <div class="form-group select "><label for="withdrawal-method">Withdrawal Method</label><select name="withdrawal_method" class="form-control" id="withdrawal-method">
<option value="">Choose</option> <?php  while($method_res = mysqli_fetch_array($method_query))  {

?>
<option <?php if($withdrawal_method == $method_res['name']){ echo 'selected="selected"' ; }  ?> value="<?php  echo $method_res[1];?>"><?php  echo $method_res['shows'];?></option> 


<?php
    }?>
</select><span class="help-block"></span></div> </div>
<div class="col-sm-6">
<table class="table table-hover table-striped">
<tbody><tr>
<th>Withdraw Method</th>
<th>Minimum Withdrawal Amount</th>
</tr>
<?php while($profile_res = mysqli_fetch_array($profile_query))  { ?>

<tr>
<td><?php echo $profile_res['name'];  ?></td>
<td>$<?php echo $profile_res[3];  ?></td>
</tr>




<?php  }?>
</tbody></table>
</div>
</div>
</div>

<div class="card">
            <div class="card-body">

<div class="form-group textarea ">
 



 

<p class="card-title text-primary">Withdrawal Account</p>
<textarea   name="withdrawal_account" class="form-control"  ><?php echo $withdrawal_account; ?></textarea>
   
  




    
   




   


<br>
<button class="btn mb-1 btn-rounded btn-primary" type="submit">Save</button>
</form>

</div>
</div>
</section>
        </div>


<?php
include 'footer.php';

?>
