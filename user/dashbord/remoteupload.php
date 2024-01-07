<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/remoteupload.php";
$pi = "Upload Videos";
$act = "video";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }


include 'header.php';

?>
<div class="main-content" style="min-height: 816px;">
        <section class="section">
          <div class="section-header">
            <h1>Remote URL Upload</h1>
          
          </div>  
          <div class="card">
            <div class="card-body">
              <form   id="remote">
            <div class="form-group">
                      <label>Remote URL</label>
                      <input type="text" id="url" class="form-control" name="url">
                      <input type="hidden" id="name" name="name" value="video.mp4">
                    </div>
                    <div class="form-group">
                    <div class="progress mb-3" id="progress" style="display:none;">
                      <div class="progress-bar" role="progressbar" data-width="0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">0%</div>
                    </div>
                    </div>
                    <input type="submit" class="btn btn-primary" id="btn1" value="Start Uploading" name="send" class="Button">
                    <a href="#" class="btn disabled btn-primary btn-progress" id="btn2" style="display:none;">Progress</a>
                  
                    </form>
                   
            </div>
</div>
</section>
        </div>
        <script src="jquery.min.js"></script>
        <script>
var doProgress;

function generateUniqueNameFromURL(url) {
    // Extract the file name from the URL
    var fileName = url.split('/').pop();

    // Generate a unique name based on the current timestamp
    var timestamp = new Date().getTime();
    var uniqueName = 'file_' + timestamp;

    // Combine the unique name and the original file extension (if any)
    var extension = fileName.includes('.') ? fileName.split('.').pop() : '';
    return uniqueName + (extension ? '.' + extension : '');
}

function getProgress() {
    $.ajax({
        url: '<?php echo $remote_upload_api; ?>?progress=1',
        dataType: 'json',
        type: 'POST',
        data: {
            name: $('#name').val()
        },
        success: function(data) {
            var progress = data.progress;
            $('#progress .progress-bar').css('width', progress + '%');
            $('#progress .progress-bar').attr('aria-valuenow', progress);
            $('#progress .progress-bar').html(progress + '%');

            if (data.progress >= 100) {
                clearInterval(doProgress); // Stop  Progress Var
                $('#result').html('File Successfully Uploaded!');
            }
        },
    })
}

$(document).ready(function () {
    $('#remote').submit(function (e) {

        e.preventDefault();

        if ($('#url').val() === '') return;
        if ($('#name').val() === '') return;

        // Generate a unique name based on the URL
        var uniqueName = generateUniqueNameFromURL($('#url').val());

        // Set the generated unique name as the value of the hidden input
        $('#name').val(uniqueName);

        $('#progress').show();
        $('#btn1').hide();
        $('#btn2').show();

        $.ajax({
            url: '<?php echo $remote_upload_api; ?>',
            dataType: 'json',
            type: 'POST',
            data: $(this).serialize(),
            beforeSend: function () {
                doProgress = setInterval(getProgress, 2500);
            },
            success: function (data) {
                if (data.status) {
                     // Get the file name
        var fileName = $('#name').val();

// Make a POST request with the file name
$.ajax({
    url: '<?php echo $remote_upload_api2; ?>', // Replace with your actual server API endpoint
    dataType: 'json',
    type: 'POST',
    data: { file: fileName },
    success: function(response) {
        // Handle the response as needed
        console.log(response);
    },
    error: function(error) {
        // Handle the error
        console.error(error);
    }
});
                    // Show alert
                    alert('Video Successfully Uploaded');

                    // Redirect to a new page (change 'newPage.html' to your desired URL)
                    window.location.href = 'videos.php';
                } else {
                    alert('Sorry, something went wrong');
                }
            },
        })
    });
});
</script>

  <?php

include 'footer.php';

?>
