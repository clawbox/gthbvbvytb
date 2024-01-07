
<?php
include $_SERVER['DOCUMENT_ROOT']."/shorturl/header.php";
include 'controllers/detection.php';
include $_SERVER['DOCUMENT_ROOT']."/user/dashbord/vendor/autoload.php";
use phpseclib3\Net\SFTP;
// down

$down_sql = "Select * from settings where id = 16";
$down_query = mysqli_query($con,$down_sql);
$down_data = mysqli_fetch_array($down_query);
$down = $down_data['value'];

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
$filename = "/uploads/videos/$drn_name";
$duration = shell_exec("ffprobe -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filename");

$duration_hours = gmdate("H", $duration);
$duration_minutes = gmdate("i", $duration);
$duration_seconds = gmdate("s", $duration);
$filesize = filesize($filename);
$user_datax_sql = "SELECT * FROM `users` WHERE id = '$user_id'";
$user_datax_query = mysqli_query($con,$user_datax_sql);
$user_datax = mysqli_fetch_assoc($user_datax_query);
$plan = $user_datax['plan'];
if($plan == 1) {

$user_data_sql = "SELECT * FROM `settings` WHERE id = '17'";
$user_data_query = mysqli_query($con,$user_data_sql);
$user_data = mysqli_fetch_assoc($user_data_query);
$web = $user_data['value'];
}else {

  $plan_sql = "SELECT * FROM `plan` WHERE id = '$plan'";
  $plan_query = mysqli_query($con,$plan_sql);
  $plan_data = mysqli_fetch_array($plan_query);
$web = $plan_data['web'];


}
if($st_server == 1) {
$videoUrl = "https://$main_domain/$drn_name";


}else {
  $server_data_sql = "SELECT * FROM `server` WHERE id = '$st_server'";
  $server_data_query = mysqli_query($con,$server_data_sql);
  $server_data = mysqli_fetch_assoc($server_data_query);
$host = $server_data['hostname'];
$drn_name = "https://$host/$drn_name";
$videoUrl = $drn_name;

if(isset($_POST['download'])) {
  $url = "http://{$main_domain}/shorturl/controllers/open.php";
  $options = array(
      'http' => array(
          'method'  => 'POST',
          'header'  => 'Content-Type: application/json',
          'content' => json_encode(array(
              'alies' => $l,
              'user_ip' => getUserIpAddr(),
              'referer_domain' => $refers
          ))
      )
  );

  $context = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  
  if ($response === false) {
      echo "Error fetching URL";
  } else {
      $data = json_decode($response, true);
      var_dump($data);
  }
  
 
  $host = $server_data['hostname'];
  $username = $server_data['username'];
  $password = $server_data['password'];
 
 // Remote file path to delete
 $remoteFilePath = $server_data['path'].$drn_name2;
 
 // Initialize SFTP object
 $sftp = new SFTP($host);
 
 // Connect to the SFTP server
 if (!$sftp->login($username, $password)) {
  exit('Login Failed');
 }



// Set the custom name for the downloaded file
$customFileName = $file_name;

// Get the contents of the remote file
$fileContents = $sftp->get($remoteFilePath);

// Set the appropriate headers for the download
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $customFileName . '"');

// Output the file contents to the browser
echo $fileContents;

// Disconnect from the SFTP server
$sftp->disconnect();



}

}

$user_username = $user_datax['username'];
$first_four = substr($user_username, 0, 4);
$masked_string = $first_four . str_repeat('*', strlen($user_username) - 4);
$datetime = new DateTime($created);
$dateOnly = $datetime->format('Y-m-d');

$ch = curl_init($videoUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);

if ($response !== false) {
    $headers = explode("\r\n", $response);
    foreach ($headers as $header) {
        if (stripos($header, 'Content-Length:') !== false) {
            $fileSizeBytes = intval(trim(substr($header, 15)));
            $fileSizeKB = round($fileSizeBytes / 1024, 2);

            if ($fileSizeKB < 1024) {
                $filesize = "$fileSizeKB KB";
            } elseif ($fileSizeKB >= 1024 && $fileSizeKB < 1024 * 1024) {
                $fileSizeMB = round($fileSizeKB / 1024, 2);
               $filesize ="$fileSizeMB MB";
            } else {
                $fileSizeGB = round($fileSizeKB / (1024 * 1024), 2);
                  $filesize ="$fileSizeGB GB";
            }
            break;
        }
    }
} else {
     $filesize = "Unable to fetch file size.";
}

curl_close($ch);
?>

<body>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <div class="main-content">
      <div class="full-page-overlay">
        <div class="notification-box download">
          <div class="logo-and-title">
          
            <div>
             
             
            </div>
          </div>
        </div>
     
      
      
      </div>
      <div class="header">
        <p style="width: 113px"  alt="" class="sharedisk_href"><?php  echo $name; ?></p>

                <div class="monetize-button" onclick="location.href='https://<?php echo  $main_domain; ?>'">
          <img src="/shorturl/img/money.f1c90f7bdae5e868dceb.svg" alt="">
          Monetize Your Video
        </div>
      
      </div>

     
      <div class="video-player">
        <div></div>
      

          
       
     
      
<?php if($web == 0) { ?>

<style>
.plyr__menu__content [data-plyr="download"] {
  display: none !important;
}

    #player {
        width: 478px;
        
        
    }
    /* Styles for Mobile Devices */
@media (max-width: 767px) {
  #player {
    width: 416px;
  }
}
</style>

<video id="videoplayer_html5_api" class="vjs-tech" preload="auto" dwidth="100%" data-setup="{&quot;fluid&quot;: true}" tabindex="-1" role="application" style="object-fit: contain;"></video>
    <?php
}else {
    ?>
<style>
.plyr__menu__content [data-plyr="download"] {
  display: none !important;
}

    #player {
        width: 478px;
        
        
    }
    /* Styles for Mobile Devices */
@media (max-width: 767px) {
  #player {
    width: 416px;
  }
}
.button-36 {
    --bs-blue: #1ba2f6;
    --bs-indigo: #6610f2;
    --bs-purple: #6f42c1;
    --bs-pink: #ea39b8;
    --bs-red: #e44c55;
    --bs-orange: #f1b633;
    --bs-yellow: #ffc107;
    --bs-green: #3cf281;
    --bs-teal: #3f81a2;
    --bs-cyan: #32fbe2;
    --bs-white: #fff;
    --bs-gray: #6c757d;
    --bs-gray-dark: #343a40;
    --bs-primary: #6f42c1;
    --bs-secondary: #ea39b8;
    --bs-success: #3cf281;
    --bs-info: #1ba2f6;
    --bs-warning: #ffc107;
    --bs-danger: #e44c55;
    --bs-light: #44d9e8;
    --bs-dark: #170229;
    --bs-font-sans-serif: Lato, -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    --bs-font-monospace: SFMono-Regular,Menlo,Monaco,Consolas, "Liberation Mono","Courier New",monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
    -webkit-text-size-adjust: 100%;
    padding: 0;
    -webkit-tap-highlight-color: transparent;
    font: inherit;
    overflow: visible;
    text-transform: none;
    -webkit-appearance: button;
    line-height: inherit;
    background-color: #f78d2d;
    border-radius: 8px;
    border-style: none;
    box-sizing: border-box;
    color: #FFFFFF;
    flex-shrink: 0;
    font-family: "Inter UI","SF Pro Display",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Open Sans","Helvetica Neue",sans-serif;
    font-size: 16px;
    font-weight: 500;
    height: 46px;
    text-align: center;
    width: 44%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    transition: all .5s;
    -webkit-user-select: none;
    touch-action: manipulation;
    margin-left: 13px;
    margin-right: 1.2rem;
    margin-top: 13px;
    margin-bottom: 3px;
    cursor: pointer;
    
}
.button-37 {
       --bs-blue: #1ba2f6;
    --bs-indigo: #6610f2;
    --bs-purple: #6f42c1;
    --bs-pink: #ea39b8;
    --bs-red: #e44c55;
    --bs-orange: #f1b633;
    --bs-yellow: #ffc107;
    --bs-green: #3cf281;
    --bs-teal: #3f81a2;
    --bs-cyan: #32fbe2;
    --bs-white: #fff;
    --bs-gray: #6c757d;
    --bs-gray-dark: #343a40;
    --bs-primary: #6f42c1;
    --bs-secondary: #ea39b8;
    --bs-success: #3cf281;
    --bs-info: #1ba2f6;
    --bs-warning: #ffc107;
    --bs-danger: #e44c55;
    --bs-light: #44d9e8;
    --bs-dark: #170229;
    --bs-font-sans-serif: Lato,-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
    --bs-font-monospace: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
    padding: 0;
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: transparent;
    font: inherit;
    overflow: visible;
    text-transform: none;
    -webkit-appearance: button;
    line-height: inherit;
    background-color: #f78d2d;
    border-radius: 8px;
    border-style: none;
    box-sizing: border-box;
    color: #FFFFFF;
    flex-shrink: 0;
    font-family: "Inter UI","SF Pro Display",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Open Sans","Helvetica Neue",sans-serif;
    font-size: 16px;
    font-weight: 500;
      height: 40px;
    text-align: center;
    width: 60%;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    transition: all .5s;
    -webkit-user-select: none;
    touch-action: manipulation;
    margin-left: 6.2rem;
    margin-right: 1.2rem;
    margin-top: 13px;
    margin-bottom: 3px;
    cursor: pointer;
    
}
</style>

<video id="videoplayer_html5_api" class="vjs-tech" playsinline controls controlsList="nodownload" dwidth="100%" data-setup="{&quot;fluid&quot;: true}" tabindex="-1" role="application" style="object-fit: contain;" >
	  <source src="<?php echo $drn_name; ?>" type="video/mp4" />
	</video>

<?php
}
?>
   </div>    <div class="float-card">
        <div class="main-title"><b><?php echo $file_name;  ?></b></div>
<div class="upload-info flex">
          <div class="shared-by">Shared by: <?php echo $masked_string; ?></div>
          <div class="date">Date: <?php echo $dateOnly;  ?></div>
          <div class="size">Size: <?php echo $filesize;  ?></div>
        </div>
        <div class="download-play-buttons">
       <button id="download-btn" class="button-36" onclick="down()"><i class="fa-solid fa-cloud-arrow-down"></i>  Download</button>
      
        <button id="play-btn" class="button-36" onclick="play()"><i class="fa-solid fa-circle-play"></i> Play Online</button>
        </div>
         <br>
        
         <button id="play-btn" class="button-37" onclick="location.href='https://mdisk.techybook.xyz/user/dashbord/save-to-mydisk.php?url=https://mdisk.techybook.xyz/<?php echo $l; ?>'">  Save To My Disk</button>
        <div class="share-options">
         <div class="cap-button share"  onclick="share()" ><img src="/shorturl/img/share.01902519edd6647ff04d.svg" alt=""> Share Video</div>
           <div class="cap-button download" onclick="down()"><img src="/shorturl/img/download.7245dc4ae8dce7625e37.svg" alt=""> Download</div>
          <div class="cap-button report" onclick="location.href='https://<?php  echo $main_domain; ?>/report.php?id=<?php echo $l;  ?>'"><img src="/shorturl/img/report.25afe797d5e4e2f7d5f5.svg" alt=""> Report Video</div>
        </div>
        <div style="width: 100%; height: auto"></div>
      </div>
      <div class="flex-center"></div>

   

      <div class="box" style="display: flex;">
        <div class="purple">
         
        </div>
      </div>
   
<br>

      <p style="font-size: 12px; color: #7b89a3; padding-top: 30px; margin: 0px 10px; border-top: 1px solid #c2cee3" class="notice">
 
        This website only provide service that help you convert your video to link easily. Share disk is a cloud storage service that lets you save files online
        and sync them to your devices You can report the file/video that contains a problem like copyright, porn, violence, etc, we will not provide service for
        those file/videos. Send DMCA: needhelp.savetoshare@gmail.com
      </p>
      <div class="space"></div>
     
    </div>

    <div class="bottom-sticky-adsense"></div>
<script>


function share() {
    
    
     if (navigator.share) {
        navigator.share({
            title: '<?php echo $file_name;  ?>',
            text: '<?php echo $file_name;  ?> - ',
            url: 'https://<?php echo $main_domain; ?>/<?php echo $l; ?>',
        })
    

}
}

function play() {

    const url = 'https://<?php  echo $main_domain;  ?>/shorturl/controllers/open.php';
    const options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ alies: '<?php  echo $l;  ?>',user_ip:'<?php echo getUserIpAddr(); ?>',referer_domain: '<?php  echo $refers;  ?>'  })
    };

    fetch(url, options)
      .then(response => response.json())
      .then(data => console.log(data))
      .catch(error => console.error(error));
    
    postSent = true;
 
  window.location.href = "stoxdisk://<?php  echo $main_domain;  ?>/<?php echo $drn_name; ?>", '_blank';

}
function down() {

    const url2s = 'https://<?php  echo $main_domain;  ?>/shorturl/controllers/open.php';
    const options2s = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ alies: '<?php  echo $l;  ?>',user_ip:'<?php echo getUserIpAddr(); ?>',referer_domain: '<?php  echo $refers;  ?>'  })
    };

    fetch(url2s, options2s)
      .then(response2s => response2s.json())
      .then(data2s => console.log(data2s))
      .catch(error2s => console.error(error2s));
    
    postSent2s = true;
 
  window.location.href = "https://<?php  echo $main_domain;  ?>/shorturl/download.php?id=<?php echo $l; ?>", '_blank';

}
</script>
<script>
const video = document.querySelector('#videoplayer_html5_api');
let postSents = false;
let videoDuration = 0; // Initialize with 0
let percentPlayed = 0;
let currentTime = 0;
video.addEventListener('loadedmetadata', function() {
  console.log('Video metadata loaded');
  videoDuration = video.duration; // Update the videoDuration once metadata is loaded
});


video.addEventListener('timeupdate', function() {
 
   currentTime = video.currentTime;
   percentPlayed = (currentTime / videoDuration) * 100;
   const roundedPercent = percentPlayed.toFixed(2);
if (percentPlayed >= 25  && !postSents) {
  console.log('Condition met!');
    const url = 'https://<?php  echo $main_domain;  ?>/shorturl/controllers/open.php';
    const options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ alies: '<?php  echo $l;  ?>',user_ip:'<?php echo getUserIpAddr(); ?>',referer_domain: '<?php  echo $refers;  ?>'  })
    };

    fetch(url, options)
      .then(response => response.json())
      .then(data => console.log(data))
      .catch(error => console.error(error));
    
    postSents = true;
}
});




  </script>
