<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">


  <title><?php  echo $pi;  ?></title>
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
        <a href="#" class="navbar-brand">Mdisk <span class="text-primary">Upload.</span></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
              <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item <?php if($pi == "DMCA") {  echo "active"; } ?>">
              <a class="nav-link" href="dmca.php">DMCA</a>
            </li>
            <li class="nav-item <?php if($pi == "Terms & Conditions") {  echo "active"; } ?>">
              <a class="nav-link" href="terms.php">Terms &amp; Condition</a>
            </li>
            <li class="nav-item <?php if($pi == "Privacy & Policy") {  echo "active"; } ?>">
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