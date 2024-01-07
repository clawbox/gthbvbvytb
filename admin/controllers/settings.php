<?php


$succ=false;
// Site Name
$namesql = "Select * from settings where id = 1 ";
$dataquery = mysqli_query($con,$namesql) ;
$namedata = mysqli_fetch_array($dataquery);
$site_name = $namedata['value'];

// Discription 
$descriptionsql = "Select * from settings where id = 2 ";
$disquery = mysqli_query($con,$descriptionsql) ;
$disdata = mysqli_fetch_array($disquery);
$site_dis = $disdata['value'];

// Maintenance Mode

$mainten_sql = "Select * from settings where id = 13 ";
$mainten_query = mysqli_query($con,$mainten_sql);
$mainten_data = mysqli_fetch_array($mainten_query);
$site_maintenance = $mainten_data['value'];



// Refer Percentage 

$refer_sql = "Select * from settings where id = 6 ";
$refer_query = mysqli_query($con,$refer_sql);
$refer_data = mysqli_fetch_array($refer_query);
$refer = $refer_data['value'];

$st_server_sql = "SELECT * FROM `settings` WHERE id = '18'";
$st_server_query = mysqli_query($con,$st_server_sql);
$st_server_data = mysqli_fetch_assoc($st_server_query);
$st_server = $st_server_data['value'];



// Main Domain
$main_domain_sql = "Select * from settings where id = 3";
$main_domain_query = mysqli_query($con,$main_domain_sql);
$main_domain_data = mysqli_fetch_array($main_domain_query);
$main_domain = $main_domain_data['value'];

// Signup Bonus 

$signup_bonus_sql = "Select * from settings where id = 4";
$signup_bonus_query = mysqli_query($con,$signup_bonus_sql);
$signup_bonus_data = mysqli_fetch_array($signup_bonus_query);
$signup_bonus = $signup_bonus_data['value'];

// Close Registration

$close_registration_sql = "Select * from settings where id = 9";
$close_registration_query = mysqli_query($con,$close_registration_sql);
$close_registration_data = mysqli_fetch_array($close_registration_query);
$close_registration = $close_registration_data['value'];

// favicon_url 

$favicon_url_sql = "Select * from settings where id = 11";
$favicon_url_query = mysqli_query($con,$favicon_url_sql);
$favicon_url_data = mysqli_fetch_array($favicon_url_query);
$favicon_url = $favicon_url_data['value'];


// logo url 

$logo_url_sql = "Select * from settings where id = 12";
$logo_url_query = mysqli_query($con,$logo_url_sql);
$logo_url_data = mysqli_fetch_array($logo_url_query);
$logo_url = $logo_url_data['value'];

// inactive

$inactive_sql = "Select * from settings where id = 14";
$inactive_query = mysqli_query($con,$inactive_sql);
$inactive_data = mysqli_fetch_array($inactive_query);
$inactive = $inactive_data['value'];

// withdraw

$withdraw_sql = "Select * from settings where id = 15";
$withdrawe_query = mysqli_query($con,$withdraw_sql);
$withdraw_data = mysqli_fetch_array($withdrawe_query);
$withdraw = $withdraw_data['value'];


// down

$down_sql = "Select * from settings where id = 16";
$down_query = mysqli_query($con,$down_sql);
$down_data = mysqli_fetch_array($down_query);
$down = $down_data['value'];

// web

$web_sql = "Select * from settings where id = 17";
$web_query = mysqli_query($con,$web_sql);
$web_data = mysqli_fetch_array($web_query);
$web = $web_data['value'];



// Short Domain

$short_sql = "Select * from settings where id = 19";
$short_query = mysqli_query($con,$short_sql);
$short_data = mysqli_fetch_array($short_query);
$short = $short_data['value'];

if(isset($_POST['maintenance'])){  

$site_maintenance = $_POST['maintenance'];
$site_name = $_POST["sitename"] ;
$site_dis = $_POST["discription"];
$favicon_url = $_POST['favicon_site'];
$logo_url = $_POST['logo'];
$refer = $_POST['refer'];
$main_domain = $_POST['maindomain'];
$inactive = $_POST['inactive'];
$close_registration = $_POST['close'];
$withdraw = $_POST['with'];
$down = $_POST['down'];
$web = $_POST['web'];
$st_server = $_POST['server'];
$short = $_POST['short'];


$update = "UPDATE settings SET value ='$site_maintenance'    WHERE id= 13 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$site_name'    WHERE id= 1 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$site_dis'    WHERE id= 2 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$favicon_url'    WHERE id= 11 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$logo_url'    WHERE id= 12 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$refer'    WHERE id= 6 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$main_domain'    WHERE id= 3 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$inactive'    WHERE id= 14 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$close_registration'    WHERE id= 9 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$withdraw'    WHERE id= 15 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$down'    WHERE id= 16 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$web'    WHERE id= 17 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$st_server'    WHERE id= 18 ";
$result = mysqli_query($con,$update);
$update = "UPDATE settings SET value ='$short'    WHERE id= 19 ";
$result = mysqli_query($con,$update);

$succ=true;
$massset = "Settings Update Successful ";




}



if(isset($_POST['cpassword'])){  

$cupassword = $_POST['cpassword'];
$new1pass = $_POST['new1pass'];
$new2pass = $_POST['new2pass'];

   
$chng_sql = "SELECT * FROM `admin` WHERE id ='2'";
$chan_query = mysqli_query($con,$chng_sql);
$res_change_pass = mysqli_fetch_assoc($chan_query);
$passx = $res_change_pass['password'];
    if(password_verify($cupassword,$passx)) {

    
if($new1pass == $new2pass) {
    $has_new  = password_hash($new1pass,PASSWORD_DEFAULT);
    $update_pass_sql = "UPDATE `admin` SET `password`='$has_new' WHERE id='2'";
    $update_pass_query = mysqli_query($con,$update_pass_sql);
    if($update_pass_query) {

        $succ=true;
        $massset = "Password was changed Now.";

    }
else {
    $succ=true;
    $massset = "Something was Wrong.";

}

    
    
    }
    else {
        
        $succ=true;

        $massset = "Oops! New Password And Re-enter New Password are Not the same . Please make the correction.";
        
            }
     
    }

    else {

        $succ=true;

        $massset = "Oops! There are mistakes in Current Password. Please make the correction.";

    }
 





}








?>