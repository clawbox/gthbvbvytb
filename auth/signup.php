<?php
 session_start();
if(isset($_SESSION['loggedin']) ){

header("location:/user/dashbord/index.php");
exit;
}
$aff = "";

if(isset($_COOKIE["aff"])){

  $aff = $_COOKIE['aff'];

} else {

  $aff = 0;

}
include '../config/config.php';
include '../controller/home.php';
include '../controller/signup.php';
if($site_maintenance == 1) {
    
  echo "The site is under maintenance";
  die();
}

?>
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   
  <!-- General CSS Files -->
  <link rel="stylesheet" href="/dash/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/dash/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/dash/assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/dash/assets/css/style.css">
  <link rel="stylesheet" href="/dash/assets/css/components.css">
</head>
<body >
    
<div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
             
            </div>

                             <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>
              <div class="card-body">
    <form method="post" class="needs-validation">
   
    <?php
if(!empty($msg)) {

?>
    <div class="alert alert-danger" role="alert">
  <?php echo $msg; ?>
</div>
<?php
}
?>
   <div class="form-group">
   <label for="username">Username</label>
          <input type="text" name="username"  class="form-control" required placeholder="Username">
         
        </div>
       
   
      <div class="form-group">
      <label for="email">Email</label>
          <input type="text" name="email"  class="form-control" required placeholder="Enter your Email">
        
        </div>
       
      
    <div class="form-group">
    <label for="password">Password</label>
          <input name="password"  class="form-control" type="password" required placeholder="Password">
          
        </div>
       
     
   <div class="form-group">
   <label for="password_compare">Confirm Password</label>
          <input name="password_compare"  class="form-control" type="password" required placeholder="Confirm Password">
         
       
       
      </div>
      <input type="hidden" name="refer" class="form-control" value="<?php echo $aff;  ?>" >
      <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
      </div>
    </form>
    </div>
            </div>
            <div class="mt-5 text-muted text-center">Back To  <a href="signin.php">Login</a></div>
            <div class="simple-footer">
              Copyright &copy; <?php echo $name; ?> 2024
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    
  <!-- General JS Scripts -->
  <script src="/dash/assets/modules/jquery.min.js"></script>
  <script src="/dash/assets/modules/popper.js"></script>
  <script src="/dash/assets/modules/tooltip.js"></script>
  <script src="/dash/assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="/dash/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="/dash/assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="/dash/assets/js/scripts.js"></script>
  <script src="/dash/assets/js/custom.js"></script>
</body>
</html>