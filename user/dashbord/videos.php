<?php

session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){

header("location:/auth/signin.php");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/home.php";
include $_SERVER['DOCUMENT_ROOT']."/controller/dashbord.php";

$pi = "Manage Videos";
$act = "video";


if($maindata['status'] == "inactive") {

 

   session_unset();
   session_destroy();
   
   header("location:/auth/signin.php");
      exit;
   
   }

   $start = 0;
   $per_page = 10;
   $current_page = 1;
   if(isset($_GET['page'])) {
   
   
   $start = $_GET['page'];
   $current_page = $start;
   $start --;
   $start = $start*$per_page;
   
   
   
   }
   
// Short Domain

$short_sql = "Select * from settings where id = 19";
$short_query = mysqli_query($con,$short_sql);
$short_data = mysqli_fetch_array($short_query);
$short = $short_data['value'];
include 'header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<div class="main-content" style="min-height: 816px;">
        <section class="section">
          <div class="section-header">
            <h1>Manage Video</h1>
          
          </div>

          <div class="section-body">
           
            <div class="card">
            <div class="card-body">
            <form method="post" accept-charset="utf-8" >
               <p class="">Alias:</p><input type="text" class="form-control"  name="alias" required  placeholder="Alias" id="filter-alias" > 


           <br>     

<button type="submit" class="form-control btn-rounded btn btn-primary" style="
    width: 134px;
">Search Links</button>

</form>
<br>

            
            
<div class="table-responsive"> 
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Link</th>
                                                <th scope="col">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

while($data = mysqli_fetch_array($video_query)) {  

?>
                                            <tr>
                                            <th scope="row"><?php if (mb_strlen($data['file_name']) >= 12) {
  echo mb_substr($data['file_name'], 0, 13) . "..."; // Truncate the file name to 13 characters and append "..."
} else {
echo  $data['file_name'];


}
 ?></th>
                                                <td ><p id="copy-text">https://<?php if(empty($short)) { echo $main_domain; } else {  echo $short;  } ?>/<?php echo $data['alies']; ?></p><i id="copy-icon" class="fa fa-copy"></i></td>
                                               
                                                <td>
                                                    <div class="dropdown custom-dropdown">
                                            <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="dropdown" aria-expanded="false">Action  <i class="fa fa-angle-down m-l-5"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-31px, 28px, 0px);"><a class="dropdown-item" href="edit.php?id=<?php echo $data['alies']; ?>"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
<a href="delete.php?id=<?php echo $data['alies']; ?>" class="dropdown-item" >Delete</a>
                                            </div>
                                        </div>
</td>
                                                
                                            </tr>
                                            <?php
}
?>
                                        </tbody>
                                    </table>
                                </div>
                                <script>
  const copyText = document.getElementById('copy-text');
  const copyIcon = document.getElementById('copy-icon');

  copyIcon.addEventListener('click', () => {
    navigator.clipboard.writeText(copyText.textContent)
      .then(() => {
        alert('Link copied to clipboard');
      })
      .catch((err) => {
       
      });
  });
</script>
              </div>
              
            </div>
          </div>
        </section>
      </div>


<?php
include 'footer.php';

?>
