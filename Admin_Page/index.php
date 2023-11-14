<?php
  include "../classes/userContr.classes.php";
  include "../includes/records.inc.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

if(isset($user)){
      
  $name = $user['first_name'].' ' .$user['last_name'];
;
  $role = $user['role'];
  if(isset($role) == '1'){


?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<style>
    .dashboard-image1{
      position: absolute;
      z-index: 999999;
      margin-top: 5px;
      margin-left: 5px;
    }
  
</style>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    <img src="../img/logo.png">
                <div class="sidebar-brand-text mx-3">PBAMS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <div class="row">
                        <div class="col d-flex justify-content-center"> 
                            <div class="profile-picture">
                                <img class="rounded-circle" src="../img/Profile.png" width="100" height="100">
                            </div>
                           
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col d-flex justify-content-center">
                            <div class="admin-name">
                                <?php echo $name; ?>
                                <br>
                                <small>Administrator</small>
                            </div>
                        </div>
                    </div>
                   
                
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-users"></i>
                    <span>List of Accounts</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Registered Users</h6>
                        <a class="collapse-item" href="students.php">Students</a>
                        <a class="collapse-item" href="professors.php">Professors</a>
                        <a class="collapse-item" href="users.php">Sub-Admin</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="subjects.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Subjects</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="records.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Records</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="sms.php">
                    <i class="fas fa-fw fa-sms"></i>
                    <span>SMS</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="barcode.php">
                    <i class="fas fa-fw fa-sms"></i>
                    <span>Barcode Scanner</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $name; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content Row -->
                    <div class="row">
                       
                        <div class="admin-container">
                            <div class="admin-card">
                                <h4><b>Dashboard</b></h4>   <br> 
                  
                                <div class="row d-flex justify-content-center">
                                  <div class="col-sm-6 p-5">
                           
                                    <div class="card">
                                    <div class="dashboard-image1">
                                      <img  src="../img/lg/Studs.jpg" width="150" height="150">
                                      </div>
                                        <div class="card-body">
                                          <p class="text-right mb-0 font-weight-bold text-gray-800">Students</p>
                                          <p class="text-right text-gray-800"><?=  $recoords->countAllStudents()['count']; ?></p>
                                          <hr>
                                          <div class="d-flex justify-content-center"><a href="students.php" class="btn btn-link"><i class="fa fa-solid fa-eye"></i>Show all</a></div> 
                                        </div>
                                    </div>
                                  </div>

                                  <div class="col-sm-6 p-5">
                                    <div class="dashboard-image1">
                                     <img  src="../img/lg/professor.png" width="150" height="150">
                                    </div>
                                    <div class="card">
                                      <div class="card-body">
                                          <p class="text-right mb-0 font-weight-bold text-gray-800">Professor</p>
                                          <p class="text-right text-gray-800"><?=  $recoords->countAllProfessors(); ?></p>
                                          <hr>
                                          <div class="d-flex justify-content-center"><a href="professors.php" class="btn btn-link"><i class="fa fa-solid fa-eye"></i>Show all</a></div> 
                                      </div>
                                    </div>
                                  </div>
                                </div>
                    
                                <div class="row d-flex justify-content-center">
                                    <div class="col-sm-6 p-5">
                                        <div class="dashboard-image1">
                                        <img  src="../img/lg/Sub_admin.jpg" width="150" height="150">
                                        </div>
                                        <div class="card">
                                          <div class="card-body">
                                            <p class="text-right mb-0 font-weight-bold text-gray-800">Sub-Admin</p>
                                            <p class="text-right text-gray-800"><?=  $recoords->countAllSubAdmin(); ?></p>
                                            <hr>
                                            <div class="d-flex justify-content-center"><a href="users.php" class="btn btn-link"><i class="fa fa-solid fa-eye"></i>Show all</a></div> 
                                          </div>
                                        </div>
                                      </div>

                                    <div class="col-sm-6 p-5">
                                        <div class="dashboard-image1">
                                        <img  src="../img/lg/Records.png" width="150" height="150">
                                        </div>
                                        <div class="card">
                                          <div class="card-body">
                                            <p class="text-right mb-0 font-weight-bold text-gray-800">Records</p>
                                            <p class="text-right text-gray-800"><?= $recoords->countAllRecords(); ?></p>
                                            <hr>
                                            <div class="d-flex justify-content-center"><a href="records.php" class="btn btn-link"><i class="fa fa-solid fa-eye"></i>Show all</a></div> 
                                          </div>
                                        </div>
                                    </div>
                                  </div>

                                  <div class="row mt-5 d-flex justify-content-center">
                                    <div class="col-sm-6 mb-4">
                                      <div class="card">
                                        <div class="card-body">
                                          <h5 class="card-title mb-0 font-weight-bold text-gray-800 text-center">Absentees in 1 month</h5>

                                            <div class="card-body">
                                                <div class="chart-pie pt-4 pb-2">
                                                    <canvas id="myPieChart"></canvas>
                                                </div>
                                                <div class="text-center small">
                                                  <span class="mr-2">
                                                      <i class="fas fa-circle text-primary"></i> Direct
                                                  </span>
                                                  <span class="mr-2">
                                                      <i class="fas fa-circle text-success"></i> Social
                                                  </span>
                                                  <span class="mr-2">
                                                      <i class="fas fa-circle text-info"></i> Referral
                                                  </span>
                                                </div>
                                              </div>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                
                            </div>
                          </div> 


                    <!-- Content Row -->
                    <div class="row">

                     

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PBAMS</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../includes/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
       <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-pie-demo.js"></script>

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