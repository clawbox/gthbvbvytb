
<!DOCTYPE html>

<html lang="en-us">

<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">

    
    <title><?php echo $pi;  ?></title>
   
    <!-- Favicon -->
    <link rel="icon" href="<?php echo $favicon_url; ?>" type="image/x-icon">
      <!-- General CSS Files -->
  <link rel="stylesheet" href="/dash/assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/dash/assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="/dash/assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="/dash/assets/modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="/dash/assets/modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="/dash/assets/modules/summernote/summernote-bs4.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="/dash/assets/css/style.css">
  <link rel="stylesheet" href="/dash/assets/css/components.css">
   
   
   
</head>
<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
           
          </ul>
         
</div>
        <ul class="navbar-nav navbar-right">
       
       
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="/dash/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $username; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
             
              <a href="profile.php" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="withdraws.php" class="dropdown-item has-icon">
                <i class="fas fa-wallet"></i> Balance: $<?php echo $Balance;  ?>
              </a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/"><?php echo $name; ?></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="/"></a>
          </div>
          <ul class="sidebar-menu">
          <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="upload.php" class="btn btn-primary btn-lg btn-block btn-icon-split">
              <i class="fas fa-cloud-upload-alt	"></i> Upload Video
            </a>
          </div>
            <li <?php  if($pi == "Dashbord") {  echo 'class="active"';   } ?>>
              <a href="/user/dashbord/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
             
            </li>
            <li <?php  if($pi == "Manage Videos") {  echo 'class="active"';   } ?>> <a class="nav-link" href="videos.php"><i class="far fa-play-circle	"></i> <span>Manage Video</span></a></li>
            <li class="dropdown">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-alt"></i> <span>Account Settings </span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="change-password.php">Change Password</a></li>
                <li><a class="nav-link" href="profile.php">Setup withdraw method</a></li>
               
              </ul>
            </li>
                    <li <?php  if($pi == "Withdraws") {  echo 'class="active"';   } ?>><a class="nav-link" href="withdraws.php"><i class="fas fa-money-bill-wave"></i> <span>Withdraw</span></a></li>      
                  
                    
                    <li <?php  if($pi == "Referrals") {  echo 'class="active"';   } ?>><a class="nav-link" href="referral.php"><i class="fas fa-users"></i> <span>Referrals</span></a></li>      
                <li <?php  if($pi == "Save To My Disk") {  echo 'class="active"';   } ?>><a class="nav-link" href="save-to-mydisk.php"><i class="fa fa-save	"></i> <span>Save To My Disk</span></a></li>      
              
                </ul> 

             </aside>
      </div>

