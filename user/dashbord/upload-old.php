<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";

$pi = "Upload Videos";
$act = "video";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }


include 'header.php';
if($st_server == 1) {
?>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  
<!-- (B) LOAD PLUPLOAD FROM CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.5/plupload.full.min.js"></script>
<style>
 .wrapper{
  width: 430px;
  background: #fff;
  border-radius: 5px;
  padding: 30px;

}
@media only screen and (max-width: 767px) {
   .wrapper{
  width: 329px;

}
}

.wrapper header{
  color: #6990F2;
  font-size: 27px;
  font-weight: 600;
  text-align: center;
}
.wrapper form{
  height: 167px;
  display: flex;
  cursor: pointer;
  margin: 30px 0;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border-radius: 5px;
  border: 2px dashed #6990F2;
}
form :where(i, p){
  color: #6990F2;
}
form i{
  font-size: 50px;
}
form p{
  margin-top: 15px;
  font-size: 16px;
}
section .row{
  margin-bottom: 10px;
  background: #E9F0FF;
  list-style: none;
  padding: 15px 20px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
section .row i{
  color: #6990F2;
  font-size: 30px;
}
section .details span{
  font-size: 14px;
}
.progress-area .row .content{
  width: 100%;
  margin-left: 15px;
}
.progress-area .details{
  display: flex;
  align-items: center;
  margin-bottom: 7px;
  justify-content: space-between;
}
.progress-area .content .progress-bar{
  height: 6px;
  width: 100%;
  margin-bottom: 4px;
  background: #fff;
  border-radius: 30px;
}
.content .progress-bar .progress{
  height: 100%;
  width: 0%;
  background: #6990F2;
  border-radius: inherit;
}
.uploaded-area{
  max-height: 232px;
  overflow-y: scroll;
}
.uploaded-area.onprogress{
  max-height: 150px;
}
.uploaded-area::-webkit-scrollbar{
  width: 0px;
}
.uploaded-area .row .content{
  display: flex;
  align-items: center;
}
.uploaded-area .row .details{
  display: flex;
  margin-left: 15px;
  flex-direction: column;
}
.uploaded-area .row .details .size{
  color: #404040;
  font-size: 11px;
}
.uploaded-area i.fa-check{
  font-size: 16px;
}
.copy-link {
  background-color: #007bff;
  color: #fff;
  border: none;
  padding: 8px 16px;
  font-size: 14px;
  cursor: pointer;
}

.copy-link:hover {
  background-color: #0069d9;
}

.copy-link:focus {
  outline: none;
  box-shadow: none;
}

</style>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
          <div class="section-header">
            <h1>Video Upload</h1>
          
          </div>  
          <div class="card">
            <div class="card-body">
<center>
  <div class="wrapper">
    <header>Video Uploader </header>
    <form action="#">
      <input class="file-input" id="video" type="file" name="video"  hidden>
      <i class="fas fa-cloud-upload-alt"></i>
      <p>Browse File to Upload</p>
      
    </form>
    <section class="progress-area"></section>
    <section class="uploaded-area"></section>
  </div>
  <p>Max Upload Size - 3GB</p>
  <a href="remoteupload.php">Upload File Using Remote Url</a>
  </center>
<script>
window.onload = () => {
const form = document.querySelector("form");
var fileInput = document.querySelector(".file-input");
const progressArea = document.querySelector(".progress-area");
const uploadedArea = document.querySelector(".uploaded-area");

form.addEventListener("click", () => {
  fileInput.click();
});

fileInput.onchange = ({ target }) => {
  var file = target.files[0];
  if (file) {
    let fileName = file.name;
    if (fileName.length >= 12) {
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
      
    }
    
  
  }
};



  // (C2) INIT PLUPLOAD
  var uploader = new plupload.Uploader({
    runtimes: "html5",
    browse_button: "video",
    url: "uploadvideo2.php",
    chunk_size: "10mb",
    init: {
      
      FilesAdded: (up, files) => {
          
     var allowedExtensions = ['mp4', 'mov', 'avi', 'wmv', 'mkv']; // Add any other video file extensions you want to allow
    var maxFileSize = 200 * 1024 * 1024; // 3GB in bytes

    // Iterate through added files
    plupload.each(files, function(file) {
      var fileExtension = file.name.split('.').pop().toLowerCase();

      // Check file extension
      if (allowedExtensions.indexOf(fileExtension) === -1) {
        alert("Invalid file format. Only MP4, MOV, AVI, WMV, and MKV files are allowed.");
        uploader.removeFile(file);
        return;
      }

      // Check file size
      if (file.size > maxFileSize) {
        alert("File size exceeds the maximum limit of 200MB as this is demo.");
        uploader.removeFile(file);
        return;
      }
      let fileName = file.name;
    if (fileName.length >= 12) {
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
    }
        
        });
        uploader.start();
      },
      UploadProgress: (up, file) => {
        var fileName = file.name;
  if (fileName.length >= 12) {
    let splitName = fileName.split('.');
    fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
  }
      var progressHTML = `
          <li class="row">
            <i class="fas fa-file-alt"></i>
            <div class="content">
              <div class="details">
                <span class="name">${fileName} (${plupload.formatSize(file.size)})• Uploading</span>
                <span class="percent">${file.percent}%</span>
              </div>
              <div class="progress-bar">
                <div class="progress" style="width: ${file.percent}%"></div>
              </div>
            </div>
          </li>`;
        uploadedArea.classList.add("onprogress");
        progressArea.innerHTML = progressHTML;
        if (file.percent >= 99.9) {
          var progressHTML = `
          <li class="row">
            <div class="content upload">
              <i class="fas fa-file-alt"></i>
              <div class="details">
                <span class="name">${fileName} • Uploaded</span>
                <span class="size">${plupload.formatSize(file.size)}</span>
              </div>
            </div>
            <i class="fas fa-check"></i>
          </li>`;
          uploadedArea.classList.add("onprogress");
        progressArea.innerHTML = progressHTML;


        }
      },
       ChunkUploaded: function (up, file, response) {
        var progressHTML = `
        <li class="row">
            <div class="content upload">
              <i class="fas fa-file-alt"></i>
              <div class="details">
                <span class="name">${fileName} • Uploaded</span>
                <span class="size">${plupload.formatSize(file.size)}</span>
              </div>
            </div>
            <i class="fas fa-check"></i>
          </li>`;
        uploadedArea.classList.remove("onprogress");
        uploadedArea.insertAdjacentHTML("afterbegin", progressHTML);
      },
      Error: (up, err) => console.error(err)
    }
  });
  uploader.init();

function getFileSizeString(fileSize) {
  const units = ["B", "KB", "MB", "GB"];
  let size = fileSize;
  let unitIndex = 0;

  while (size >= 1024 && unitIndex < units.length - 1) {
    size /= 1024;
    unitIndex++;
  }

  return size.toFixed(2) + " " + units[unitIndex];
}
};
</script>

<br>
<br>
</div>
</div>
</section>
        </div>


<?php
}else {


  ?>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  
  <!-- (B) LOAD PLUPLOAD FROM CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/plupload/3.1.5/plupload.full.min.js"></script>
  <style>
   .wrapper{
    width: 430px;
    background: #fff;
    border-radius: 5px;
    padding: 30px;
  
  }
  @media only screen and (max-width: 767px) {
     .wrapper{
    width: 329px;
  
  }
  }
  
  .wrapper header{
    color: #6990F2;
    font-size: 27px;
    font-weight: 600;
    text-align: center;
  }
  .wrapper form{
    height: 167px;
    display: flex;
    cursor: pointer;
    margin: 30px 0;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    border-radius: 5px;
    border: 2px dashed #6990F2;
  }
  form :where(i, p){
    color: #6990F2;
  }
  form i{
    font-size: 50px;
  }
  form p{
    margin-top: 15px;
    font-size: 16px;
  }
  section .row{
    margin-bottom: 10px;
    background: #E9F0FF;
    list-style: none;
    padding: 15px 20px;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  section .row i{
    color: #6990F2;
    font-size: 30px;
  }
  section .details span{
    font-size: 14px;
  }
  .progress-area .row .content{
    width: 100%;
    margin-left: 15px;
  }
  .progress-area .details{
    display: flex;
    align-items: center;
    margin-bottom: 7px;
    justify-content: space-between;
  }
  .progress-area .content .progress-bar{
    height: 6px;
    width: 100%;
    margin-bottom: 4px;
    background: #fff;
    border-radius: 30px;
  }
  .content .progress-bar .progress{
    height: 100%;
    width: 0%;
    background: #6990F2;
    border-radius: inherit;
  }
  .uploaded-area{
    max-height: 232px;
    overflow-y: scroll;
  }
  .uploaded-area.onprogress{
    max-height: 150px;
  }
  .uploaded-area::-webkit-scrollbar{
    width: 0px;
  }
  .uploaded-area .row .content{
    display: flex;
    align-items: center;
  }
  .uploaded-area .row .details{
    display: flex;
    margin-left: 15px;
    flex-direction: column;
  }
  .uploaded-area .row .details .size{
    color: #404040;
    font-size: 11px;
  }
  .uploaded-area i.fa-check{
    font-size: 16px;
  }
  .copy-link {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 8px 16px;
    font-size: 14px;
    cursor: pointer;
  }
  
  .copy-link:hover {
    background-color: #0069d9;
  }
  
  .copy-link:focus {
    outline: none;
    box-shadow: none;
  }
  #loading-message {
      display: none;
      margin-top: 10px;
    }
    #link-container {
      display: none;
      margin-top: 10px;
    }
  </style>
  <div class="content-wrapper">
  
  <div class="container-xxl flex-grow-1 container-p-y">
  <div class="card">
  <div class="d-flex align-items-end row">
  <div >
  <div class="card-body">
  <center><div class="wrapper">
      <header>Video Uploader </header>
      <form action="#">
      <input class="file-input" type="file" name="file" hidden>
      <i class="fas fa-cloud-upload-alt"></i>
      <p>Browse File to Upload</p>
    </form>
      <section class="progress-area"></section>
      <section class="uploaded-area"></section>
    </div>
    <p>Max Upload Size - 3GB</p>
    <a href="remoteupload.php">Upload File Using Remote Url</a>
    </center>
  <script>
const form = document.querySelector("form"),
fileInput = document.querySelector(".file-input"),
progressArea = document.querySelector(".progress-area"),
uploadedArea = document.querySelector(".uploaded-area");

// form click event
form.addEventListener("click", () =>{
  fileInput.click();
});

fileInput.onchange = ({target})=>{
  let file = target.files[0]; //getting file [0] this means if user has selected multiple files then get first one only
  if(file){
    let fileName = file.name; //getting file name
    if(fileName.length >= 12){ //if file name length is greater than 12 then split it and add ...
      let splitName = fileName.split('.');
      fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
    }
    uploadFile(fileName); //calling uploadFile with passing file name as an argument
  }
}

// file upload function
function uploadFile(name){
  let file = fileInput.files[0]; // Get the selected file
  let fileSize = file.size; // Get the file size in bytes
  let fileType = file.type; // Get the file type

  // Check if file exceeds 3GB (3 * 1024 * 1024 * 1024 bytes)
  if (fileSize > 200 * 1024 * 1024) {
    alert('File size exceeds the maximum limit of 200MB as this is demo.');
    return; // Stop the file upload process
  }

// Check if the file is a video file
if (
  fileType !== 'video/mp4' &&
  fileType !== 'video/x-matroska' &&
  !file.name.toLowerCase().endsWith('.mp4') &&
  !file.name.toLowerCase().endsWith('.mkv')
) {
  alert('Only MP4 and MKV video files are allowed for upload.');
  return; // Stop the file upload process
}

  let xhr = new XMLHttpRequest(); //creating new xhr object (AJAX)
  xhr.open("POST", "uploadvideo.php"); //sending post request to the specified URL
  xhr.upload.addEventListener("progress", ({loaded, total}) =>{ //file uploading progress event
    let  fileLoaded = (loaded / total) * 100;
   
 
    let fileTotal = Math.floor(total / 1000); //gettting total file size in KB from bytes
    let fileSize;
    // if file size is less than 1024 then add only KB else convert this KB into MB
    (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (loaded / (1024*1024)).toFixed(2) + " MB";
    let progressHTML = `<li class="row">
                          <i class="fas fa-file-alt"></i>
                          <br>
                          <div class="content">
                             <center> <div class="details">
                              <span class="name">${name} • Uploading</span>
                             
                            </div> </center> 
                           
                           
                            </div>
                          </div>
                        <center>    Uploading... Please wait. </center>
                        </li>`;
                   
    // uploadedArea.innerHTML = ""; //uncomment this line if you don't want to show upload history
    uploadedArea.classList.add("onprogress");
    progressArea.innerHTML = progressHTML;
 
    xhr.onreadystatechange = function () {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          progressArea.innerHTML = "";
          let uploadedHTML = `<li class="row">
                                <div class="content upload">
                                  <i class="fas fa-file-alt"></i>
                                  <div class="details">
                                    <span class="name">${name} • Uploaded</span>
                                    <span class="size">${fileSize}</span>
                                  </div>
                                  <div id="link-container">
                                  <a id="download-link" href="#" onclick="copyLink(event)">Copy Link</a>
                                </div>
                                </div>
                                <i class="fas fa-check"></i>
                              </li>`;
          uploadedArea.classList.remove("onprogress");
          // uploadedArea.innerHTML = uploadedHTML; //uncomment this line if you don't want to show upload history
          uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML); //remove this line if you don't want to show upload history
          $('#loading-message').hide();
          $('#link-container').show();
          var response = JSON.parse(xhr.responseText);
          var downloadLink = document.getElementById('download-link');
          downloadLink.href = response.fileUrl;
          downloadLink.innerHTML = 'Copy Link';
          
        } else {
          alert('File upload failed!');
        }
      }
    };
 
  });
  let data = new FormData(form); //FormData is an object to easily send form data
  xhr.send(data); //sending form data
}
function copyLink(event) {
  event.preventDefault(); // Prevent the default link behavior
  var link = event.target.href; // Get the link URL from the href attribute

  // Copy the link URL to the clipboard
  navigator.clipboard.writeText(link)
    .then(function() {
      console.log('Link copied to clipboard: ' + link);
    })
    .catch(function(error) {
      console.error('Failed to copy link to clipboard: ' + error);
    });
}

  </script>
  
  <br>
  <br>
  </div>
  </div>
  </div>
  
  <?php
}
include 'footer.php';

?>
