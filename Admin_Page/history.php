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
                <li class=""><a href="index.php" class=""><img  src="../img/graph.png" > Dashboard</a></li>
                  <li class=""><a href="students.php" class=""><img  src="../img/group.svg" >Students</a></li>
                  <li class="active"><a href="history.php" class=""><img  src="../img/records.png" >History</a></li>
                  <li class=""><a href="barcode.php" class=""><img  src="../img/barcode.png">Barcode</a></li>
                  <li class=""> <a href="message.php" class=""><img  src="../img/sms.png" >Message</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="admin-container">
          <div class="admin-card">
              <h4><b>WELCOME!!!</b><br> to Attendance Monitoring System Of Polytechnic Institute of Tabaco.  </h4>     
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