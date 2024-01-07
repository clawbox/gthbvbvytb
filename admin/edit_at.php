<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}
include $_SERVER['DOCUMENT_ROOT']."/config/config.php";
$username = $_SESSION['adusername']  ;
$pi = "Announcements";
include 'header.php';

if(isset($_GET["id"]))
{

    include 'controllers/edit_at.php';
?>

<?php

if($succ) {
?>
<div class="card mb-4 py-3 border-bottom-primary">
                                <div class="card-body">
                                <?php echo $massset ;   ?>
                                </div>
                            </div>




<br>
<br>
<?php

}
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Add new Announcements </h1>


                    <form method ="POST">
               
    <label  class="form-label">Title</label>
    <input type="txt" class="form-control form-control-user" value ="<?php echo $ti; ?>"  name ="title">
  
    <br>
 
    <label class="form-label">Content</label>
    <textarea name="content" id="editor" ><?php echo  $conten; ?></textarea>
   
    <br>

 
  <button type="submit" class="btn btn-primary">Save</button>
</form>

<script>
     CKEDITOR.replace( 'editor' );
</script>
        
<?php

} else {?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

<!-- 404 Error Text -->
<div class="text-center">
    <div class="error mx-auto" data-text="404">404</div>
    <p class="lead text-gray-800 mb-5">Page Not Found</p>
    <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
    <a href="dashbord.php">&larr; Back to Dashboard</a>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php  }
include 'footer.php';  ?>
