<?php
  include "../classes/userContr.classes.php";
  include "../includes/professor.inc.php";

  $userdata = new UserCntr();
  $user = $userdata->get_userdata();



if(isset($user)){
      
  $name = $user['first_name'].' ' .$user['last_name'];
  $role = $user['role'];
  $id =$user['id'];
  if(isset($role) == '1'){


?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">

<style>
    .dashboard-image1{
      position: absolute;
      margin-top: -70px;
      z-index: 999999;
      margin-left:1em;
    }
    .table-bordered{
        color:white;
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
                                <small><?= $name == '1' ? 'Administrator' : ($name == '2' ? 'Sub Adminitstrator': 'Professor');  ?></small>
                            </div>
                        </div>
                    </div>
                   
                
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Dashboard</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=   $name ?></span>
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
                                <h4><b>Records</b></h4>   <br> 
                              
                                <div class="table-responsive">
                                <table class="display" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Schedule</th>
                                            <th>Attendance</th>
                                            <th>Status</th>
                                            <th>Time In</th>
                                        </tr>
                                    </thead>
                               
                                    <tbody>
                                        <?php 
                                        
                                            foreach($prof->getAllStudentRecords($id) as $rm){
                                        ?>
                                        <tr>
                                            <td><?= ucfirst($rm['first_name']).' '.ucfirst($rm['last_name']); ?></td>
                                            <td><?= ucfirst($rm['subject_name']); ?></td>
                                            <td><?= $rm['day'].' '. $rm['time_in'].'-'.$rm['time_out'] ?></td>
                                            <td><?= $rm['is_present'] == 1 ? 'Present' : 'Absent'?></td>
                                            <td><?= $rm['on_time'] == 1 ? 'On TIme' : 'Late' ?></td>
                                            <td><?= $rm['created_at']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                               
                                
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
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="is_present_professor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5><i class="icon fas fa-info"></i> Attendance Already Added!</h5>
                    <button type="button" class="sched_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible">
                        <center><b>Your Attendance has been recorded</b></center>
                    </div>    
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
    
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script>

        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                
                buttons: [
                    'print'
                ]
            } );
        } );

    </script>
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