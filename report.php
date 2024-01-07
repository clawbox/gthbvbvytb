<?php
include 'config/config.php';
include 'controller/home.php';
if(isset($_POST['name'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $file_id = $_GET['id'];
    $file_sql = "SELECT * FROM `files` WHERE `alies` = '$file_id'";
    $file_query = mysqli_query($con,$file_sql);
    $file_data = mysqli_fetch_array($file_query);
    $file = $file_data['id'];
    $insert_sql = "INSERT INTO `reports`( `name`, `email`, `status`, `file_id`, `message`) VALUES ('$name','$email','pending','$file','$message')";
   $insert = mysqli_query($con,$insert_sql);
?>

<html class="no-js"><head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title><?php echo $name; ?></title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&amp;display=swap" rel="stylesheet">
<style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
          margin: 0;
        }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style></head>

<body>
<div class="card">
<div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
<i class="checkmark">✓</i>
</div>
<h1>Success</h1>
<p>We received your report;<br> we'll review it and remove it shortly! <br> Thank you!</p>
</div>


</body></html>

<?php
}else {

?>

<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
<title> VIDEO REPORT</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<link rel="stylesheet" type="text/css" href="css/util.css">
<link rel="stylesheet" type="text/css" href="css/main.css">
<meta name="robots" content="noindex, follow">
</head>
<body>
<div class="container-contact100">
<div class="wrap-contact100">
<form class="contact100-form validate-form" method="post">
<span class="contact100-form-title">
Report link!
</span>
<div class="wrap-input100 validate-input bg1" data-validate="Please Type Your Name">
<span class="label-input100">FULL NAME *</span>
<input class="input100" type="text" name="name" placeholder="Enter Your Name">
</div>
<div class="wrap-input100 validate-input bg1 rs1-wrap-input100" data-validate="Enter Your Email (e@a.x)">
<span class="label-input100">Email *</span>
<input class="input100" type="text" name="email" placeholder="Enter Your Email ">
</div>
<div class="wrap-input100 bg1 rs1-wrap-input100">
<span class="label-input100">Link with issue</span>
<input class="input100" type="text" name="phone" value="https://<?php echo $main_domain ?>/<?php echo $_GET['id'] ?>" placeholder="Link Here">
</div>

<div class="wrap-input100 validate-input bg0 rs1-alert-validate" data-validate="Please Type Your Message">
<span class="label-input100">Message</span>
<textarea class="input100" name="message" placeholder="Your message here..."></textarea>
</div>
<div class="container-contact100-form-btn">
<button class="contact100-form-btn">
<span>
Submit
<i class="fa fa-long-arrow-right m-l-7" aria-hidden="true"></i>
</span>
</button>
</div>
</form>
</div>
</div>
<script src="vendor/jquery/jquery-3.2.1.min.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/animsition/js/animsition.min.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/bootstrap/js/popper.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/select2/select2.min.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>

<script src="vendor/daterangepicker/moment.min.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/daterangepicker/daterangepicker.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/countdowntime/countdowntime.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>
<script src="vendor/noui/nouislider.min.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>

<script src="js/main.js" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"73fa0c944ee98e8c","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.8.0","si":100}' crossorigin="anonymous" type="67fa13279e5b8c0f992ab4c8-text/javascript"></script>



</html>
<?php
}
?>