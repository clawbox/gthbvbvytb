<?php
include 'config/config.php';
include 'controller/home.php';
error_reporting(0);
session_start();
$mainten_sql = "Select * from settings where id = 13 ";
$mainten_query = mysqli_query($con,$mainten_sql);
$mainten_data = mysqli_fetch_array($mainten_query);
$site_maintenance = $mainten_data['value'];

if($site_maintenance == 1) {
    
    echo "The site is under maintenance";
    die();
}

// favicon_url 

$favicon_url_sql = "Select * from settings where id = 11";
$favicon_url_query = mysqli_query($con,$favicon_url_sql);
$favicon_url_data = mysqli_fetch_array($favicon_url_query);
$favicon_url = $favicon_url_data['value'];
$pi = "Privacy & Policy";
include 'header.php';
$domainx = $_SERVER['HTTP_HOST'];

?>
<div class="container">
      <div class="page-banner">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-md-6">
            <nav aria-label="Breadcrumb">
              <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Privacy &amp; Policy</li>
              </ul>
            </nav>
            <h1 class="text-center">Privacy &amp; Policy</h1>
          </div>
        </div>
      </div>
    </div>
  </header>


  <div class="page-section">
    <div class="container">
      <div class="row align-items-center">
      
          Log in Privacy Policy Privacy Policy Who we are We Provide simple, fast, free and secure Video Streaming platform. Our website address is: <?php echo $domainx; ?> Data If you create account on our site. We ask for username, email address. We store User's username, Registered Email id and Login IP Address. We ask Bank or Upi Details from users for only user's earning puspose. For users that register on our website, we also store the personal information they provide in their user profile. All users can see, edit their personal information (name, email id, and Bank Details). If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser. How long we retain your data Until you Delete your Account. Where we send your data We Don not share our users data with any other 3rd party organization. All user's Data is Confidential and secured. Company's Rights If user do any unusual activity or break any Term or policy of company then Temporary Terminate or Permanent Delete user's Account. Reports If any visitor find any type of links that contain child abuse, violation, pornography content then they can report us and we will delete link within 48 hours. When any visitor report us any link then we store visitor's Email address and IP Address.
          </div>
    </div>
  </div>
<?php
include 'footer.php';

?>