<?php

session_start();
if(!isset($_SESSION['admindin']) || $_SESSION['admindin']!=true){

header("location:../");
exit;
}

include $_SERVER['DOCUMENT_ROOT']."/config/config.php";

$username = $_SESSION['adusername']  ;
$pi = "Users";

include 'header.php';
include 'controllers/users.php';

?>
    <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Users</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  
    <div class="card-body">
    <form method="post" >
      
      <div class="form-group text "><input type="text" required="required" name="filter" class="form-control" size="0" placeholder="Username" ><span class="help-block"></span></div>
     
     
      <button class="btn btn-info btn-icon-split" type="submit"><span class="text">Filter</span></button>
</form>
<br>
<br>
<br>
<?php if(isset($_POST['filter'])) { ?>

    <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
              
                <tbody>
                    <?php 
                      $filter = $_POST['filter'];
                      $user_res2 = mysqli_query($con,"SELECT * FROM `users` WHERE username = '$filter' "); 
                       $pe_sql=mysqli_query($con,"SELECT * FROM `users` WHERE username = '$filter'  ");
                                     
                       $record = mysqli_num_rows($pe_sql);
                       $pagi = ceil($record/$per_page);



                    while($user_data = mysqli_fetch_array($user_res2)) {
                    
                    ?>
                    <tr>
                        <td><?php echo $user_data['id']; ?></td>
                        <td><?php echo $user_data['username']; ?></td>
                        <td><?php echo $user_data['status']; ?></td>
                        <td><?php echo $user_data['email']; ?></td>
                        <td><?php echo $user_data['joined']; ?></td>
                        <td><a href="view.php?id=<?php echo $user_data['id']; ?>" class="btn btn-info btn-icon-split">
                                       
                                        <span class="text">View</span>
                                    </a></td>
                    </tr>
                   <?php  }?>
                </tbody>
            </table>
            
            <ul class="pagination">
                                   <?php
                                   
                                   for($i=1;$i<=$pagi;$i++) { 

                                    $class = "";
                                      if($current_page == $i) {

                                       $class = "active";


                                      }
                                      
                                      ?>
                                   <li class="paginate_button page-item <?php echo $class;  ?>">
                                      <a href="?page=<?php echo $i;   ?>"  class="page-link"><?php echo $i;  ?></a>
                                    </li>

                                    <?php  }  ?>
                                 </ul>


    <?php  } else{ ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Userame</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Action</th>
                       
                    </tr>
                </thead>
              
                <tbody>
                    <?php 
                       $pe_sql=mysqli_query($con,"SELECT * FROM `users` ");
                                     
                       $record = mysqli_num_rows($pe_sql);
                       $pagi = ceil($record/$per_page);



                    while($user_data = mysqli_fetch_array($user_res)) {
                    
                    ?>
                    <tr>
                        <td><?php echo $user_data['id']; ?></td>
                        <td><?php echo $user_data['username']; ?></td>
                        <td><?php echo $user_data['status']; ?></td>
                        <td><?php echo $user_data['email']; ?></td>
                        <td><?php echo $user_data['joined']; ?></td>
                        <td><a href="view.php?id=<?php echo $user_data['id']; ?>" class="btn btn-info btn-icon-split">
                                       
                                        <span class="text">View</span>
                                    </a></td>
                    </tr>
                   <?php  }?>
                </tbody>
            </table>
            
            <ul class="pagination">
                                   <?php
                                   
                                   for($i=1;$i<=$pagi;$i++) { 

                                    $class = "";
                                      if($current_page == $i) {

                                       $class = "active";


                                      }
                                      
                                      ?>
                                   <li class="paginate_button page-item <?php echo $class;  ?>">
                                      <a href="?page=<?php echo $i;   ?>"  class="page-link"><?php echo $i;  ?></a>
                                    </li>

                                    <?php  }  ?>
                                 </ul>
                                 <?php  } ?>
                                </div>
    </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php  include 'footer.php';  ?>