<?php
session_start();
include 'config/config.php';
include 'controller/home.php';


$mainten_sql = "Select * from settings where id = 13 ";
$mainten_query = mysqli_query($con,$mainten_sql);
$mainten_data = mysqli_fetch_array($mainten_query);
$site_maintenance = $mainten_data['value'];

if($site_maintenance == 1) {
    
    echo "The site is under maintenance";
    die();
}


$pi = "Terms & Conditions";
include 'header.php';

?>
<div class="container">
      <div class="page-banner">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-md-6">
            <nav aria-label="Breadcrumb">
              <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Terms & Conditions</li>
              </ul>
            </nav>
            <h1 class="text-center">Terms & Conditions</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="page-section">
    <div class="container">
      <div class="row align-items-center">
      
        Terms & Conditions Terms and conditions for Content Voilance, Abuse, Child Abuse, Child porn, Any king of pornographic Content, Copyright Content is strictly Prohibited. We can remove links or Terminate users account. If they Voilates terms of Services. Reported Links Will be deleted with in 48 hours. ( Link report option available on link play page ).

        </div>
    </div>
  </div>
<?php
include 'footer.php';

?>