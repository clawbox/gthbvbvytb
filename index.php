<?php
// error_reporting(0);
session_start();
include 'config/config.php';
include 'controller/home.php';

$l = "";
$url = "";
if($site_maintenance == 1) {
    
    echo "The site is under maintenance";
    die();
}
if(isset($_GET)){
	foreach($_GET as $key=>$val){
		$l=mysqli_real_escape_string($con,$key);
		$l=str_replace('/','',$l);	
	}
	$res=mysqli_query($con,"select *  from files where alies='$l' and status='active'");
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		$file_name=$row['file_name'];
    $drn_name=$row['drn_name'];
    $drn_name2=$row['drn_name'];
 $user_id = $row['user_id'];
    $video_id = $row['id'];   
	$st_server = $row['server'];
	$created = $row['created'];	
		include 'shorturl/main.php';
		die();
	} else {
        $url.= $_SERVER['REQUEST_URI']; 
        if($url == "/")
       {
        } elseif($url == "") {



        }else {

            echo "404 not found";
            die();
        }
  
    
}
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <title><?php  echo $name;  ?></title>
	<meta name="description" content="<?php echo $Description; ?>">
  <link rel="stylesheet" href="/assets/css/maicons.css">

  <link rel="stylesheet" href="/assets/css/bootstrap.css">

  <link rel="stylesheet" href="/assets/vendor/animate/animate.css">
  <link rel="icon" type="image/x-icon" href="<?php echo $favicon_url; ?>" />
  <link rel="stylesheet" href="/assets/css/theme.css">

</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky" data-offset="500">
      <div class="container">
        <a href="#" class="navbar-brand"><?php  if(empty($logo_url)) { echo $name;  }else { ?><img src="<?php echo $logo_url; ?>" alt="<?php echo $name; ?>">
  <?php   } ?></span></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="dmca.php">DMCA</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="terms.php">Terms &amp; Condition</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="privacy.php">Privacy &amp; Policy</a>
            </li>
            <?php
if(isset($_SESSION['loggedin']) ){
?>
 <li class="nav-item">
              <a class="btn btn-primary ml-lg-2" href="/user/dashbord/" style="
              border-radius: 11px;
          ">Dashbord</a>
            </li>
            <?php
}else {
?>
            <li class="nav-item">
              <a class="nav-link" href="/auth/signin.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ml-lg-2" href="/auth/signup.php" style="
              border-radius: 11px;
          ">Get Stated</a>
            </li>
            <?php } ?>
          </ul>
        </div>

      </div>
    </nav>

    <div class="container">
      <div class="page-banner home-banner">
        <div class="row align-items-center flex-wrap-reverse h-100">
          <div class="col-md-6 py-5 wow fadeInLeft">
            <h1 class="mb-4">Upload,share and earn.</h1>
            <p class="text-lg text-grey mb-5"><?php  echo $name;  ?> Upload offers you an 100gb cloud storage for free.   </p>
            <?php
if(isset($_SESSION['loggedin']) ){
?>
 <a href="/user/dashbord/" class="btn btn-primary ml-lg-2" style="
            border-radius: 11px;
        ">Dashbord </a>
 
            <?php
}else {
?>
            <a href="/auth/signup.php" class="btn btn-primary ml-lg-2" style="
            border-radius: 11px;
        ">Get Stated </a>
           
            <?php } ?>
          
          </div>
          <div class="col-md-6 py-5 wow zoomIn">
            <div class="img-fluid text-center">
              <img src="/assets/img/upload.png" alt="">
            </div>
          </div>
        </div>
       
      </div>
    </div>
  </header>
  <div class="page-section banner-seo-check">
    <div class="wrap bg-image" style="background-image: url(../assets/img/bg_pattern.svg);">
      <div class="container text-center">
        <div class="row justify-content-center wow fadeInUp">
          <div class="col-lg-8">
            <h2 class="mb-4">"Upload Videos and Earn Money by sharing " </h2>
            
          </div>
        </div>
      </div> <!-- .container -->
    </div> <!-- .wrap -->
  </div> <!-- .page-section -->
  <div class="page-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="card-service wow fadeInUp">
            <div class="header">
              <img src="/assets/img/secure.png" alt="">
            </div>
            <div class="body">
              <h5 class="text-secondary">Fast And Secure Process </h5>
              <p>Uploading and Downloading both are Fast And Secure              </p>
              
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card-service wow fadeInUp">
            <div class="header">
              <img src="/assets/img/ssd.png" alt="">
            </div>
            <div class="body">
              <h5 class="text-secondary">100 GB free storage </h5>
              <p>All user will get 100gb for free</p>
            
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card-service wow fadeInUp">
            <div class="header">
              <img src="/assets/img/money.png" alt="">
            </div>
            <div class="body">
              <h5 class="text-secondary">Share direct links </h5>
              <p>Upload Your Files And Share With Your Friends And Family and Get Money.. You Got 10% Referlal Earning </p>

            </div>
          </div>
        </div>
      </div>
    </div> <!-- .container -->
  </div> <!-- .page-section -->





  <!-- Banner info -->
  <div class="page-section banner-info">
    <div class="wrap bg-image" style="background-image: url(../assets/img/bg_pattern.svg);">
      <div class="container">
        <div class="row align-items-center">
         
                    <div class="col-lg-4">
                        <div class="box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                            </div>
                            <div class="info">
                                <h4>6,000 +</h4>
                                <p>Files</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box-lg">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect><rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect><line x1="6" y1="6" x2="6" y2="6"></line><line x1="6" y1="18" x2="6" y2="18"></line></svg>
                            </div>
                            <div class="info">
                                <h4>6 TB +</h4>
                                <p>Disk Used</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="box">
                            <div class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div class="info">
                                <h4>1,000 +</h4>
                                <p>Users</p>
                            </div>
                        </div>
                    </div>
                </div>
            
        
      </div>
    </div> <!-- .wrap -->
  </div> <!-- .page-section -->



  <footer class="page-footer bg-image" style="background-image: url(../assets/img/world_pattern.svg);">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-3 py-3">
          <h3><?php  echo $name;  ?></h3>
          <p><?php echo $Description; ?></p>

          
        </div>
        <div class="col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
          <li><a href="dmca.php">DMCA</a></li>
            <li><a href="terms.php">Terms &amp; Condition</a></li>
            <li><a href="privacy.php">Privacy &amp; Policy</a></li>
          </ul>
        </div>
     >
      </div>

      <p class="text-center" id="copyright">Copyright &copy; 2024 <?php  echo $name;  ?>  </p>
    </div>
  </footer>

<script src="/assets/js/jquery-3.5.1.min.js"></script>

<script src="/assets/js/bootstrap.bundle.min.js"></script>

<script src="/assets/js/google-maps.js"></script>

<script src="/assets/vendor/wow/wow.min.js"></script>

<script src="/assets/js/theme.js"></script>
  
</body>
</html>