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

$pi = "DMCA";
include 'header.php';

?>
<div class="container">
      <div class="page-banner">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-md-6">
            <nav aria-label="Breadcrumb">
              <ul class="breadcrumb justify-content-center py-0 bg-transparent">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">DMCA</li>
              </ul>
            </nav>
            <h1 class="text-center">DMCA</h1>
          </div>
        </div>
      </div>
    </div>
  </header>
 

  <div class="page-section">
    <div class="container">
      <div class="row align-items-center">
        
          <h4>This wesbite only helps to convert your content link to a streaming link. You can report any link if it contains any kind of problem like (copyright, abuse, violation, child abuse, pornography). we will delete reported link within 48 hours.
</h4>
      </div>
    </div>
  </div>
<?php
include 'footer.php';

?>