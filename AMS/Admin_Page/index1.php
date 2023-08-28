<?php
  include "../classes/userContr.classes.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

if(isset($user)){
      
  $name = $user['name'];
  $role = $user['role'];
  if(isset($role) == '1'){


?>
<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php" ?>
<style>
  .dashboard-image1{
    position: absolute;
    margin-top: -30px;
    z-index: 999999;
    margin-left:1em;
  }

</style>
<body>
        <!--top navigation-->
        <div class="bg-img"></div>
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="../img/logo.png">PBAMS</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" 
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse" id="navContent">
              <ul class="navbar-nav ms-auto mb-lg-0">
                  <li class="nav-item">
                          <a class="nav-link" href="../includes/logout.php">logout</a>
                  </li>
              </ul>
            </div>
          </div>
        </nav>
        <div class="container-fluid d-flex">
          <div class="row">
            <!-- Sidebar -->
            <div class=" sidebar">
              <div class="profile-picture">
                <img src="../img/Profile.png" alt="Profile picture">
              </div>
              <div class="admin-name">
                Roy Balana
                <br>
                <small>Administrator</small>
              </div>
            
              <div class="menu list-group">
                <ul class="list-unstyled">
                <li class="active"><a href="index.php" class=""><img  src="../img/graph.png" > Dashboard</a></li>
                  <li class=""><a href="students.php" class=""><img  src="../img/group.svg" >Students</a></li>
                  <li class=""><a href="history.php" class=""><img  src="../img/records.png" >History</a></li>
                  <li class=""><a href="barcode.php" class=""><img  src="../img/barcode.png">Barcode</a></li>
                  <li class=""> <a href="message.php" class=""><img  src="../img/sms.png" >Message</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="admin-container">
          <div class="admin-card">
              <h4><b>Dashboard</b></h4>   <br> 

              <div class="row d-flex justify-content-center">
              <div class="col-sm-5 p-5">
                <div class="dashboard-image1">
                 <img  src="../img/sms.png" width="65" height="65">
                </div>
                <div class="card">
                  <div class="card-body">
                    <p class="text-end">Special title treatment</p>
                    <p class="card-text text-end"><hr></p>
                    <div class="d-flex justify-content-center"><a href="students.php" class="btn btn-link"><i class="fa fa-solid fa-eye"></i>Show all</a></div> 
                  </div>
                </div>
              </div>
              <div class="col-sm-5 p-5">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5">
            <div class="col-sm-6 p-5">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <div class="col-sm-6 p-5">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-5 d-flex justify-content-center">
            <div class="col-sm-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Special title treatment</h5>
                  <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
          </div>
              
          </div>
        </div> 
        <?php include "includes/footer.php"; ?>
</body>
</html>
<?php
 }
 else{
    header('location: ../index.php');
 }
}
else{
  header('location: ../index.php');
}

?>