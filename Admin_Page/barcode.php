<?php
  include "../classes/userContr.classes.php";
  include "../includes/sms_gateway.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

if(isset($user)){
      
  $name = $user['first_name'].' '.$user['last_name'];
  $role = $user['role'];
  if(isset($role) == '1'){


?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<script src="../includes/html5-qrcode.min.js" type="text/javascript"></script>

<style>
    
    .navbar-nav{
        z-index: 9999;

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=   $name ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal" tabindex="999">
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
                <h4><b>Bar Code Scanner</b></h4>   <br> 
                    <!-- Content Row -->
                    <div class="row">
                       
                        <div class="admin-container">
                            <div class="admin-card">
                              
                                <div class="row">
                                    <div class="col-md-6">
                                          <div class="container">
                                                <div class="row justify-content-center">
                                                       <div id="student_preview"></div>
                                                </div>
                                                <div class="row justify-content-center">
                                                        <h1 class="display-1 stud_name"></h1>
                                                </div>
                                                <div class="row justify-content-center">
                                                       <h4 class="display-4 stud_course"> </h3>
                                                </div>
                                                <div class="row justify-content-center">
                                                     
                                                </div>
                                                <!-- <div class="row justify-content-center">
                                                      <h4 class="display-4 stud_address">address</h3>
                                                </div> -->
                                                <!-- <div class="row justify-content-center">
                                                      <h4 class="display-4 stud_contact">contact</h3>
                                                </div> -->
                                                <div class="row justify-content-center">
                                                      <h4 class="display-4 time_in text-danger"></h3>
                                                </div>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <center> <div id="reader" width="600px"></div> </center>
                                    
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
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="undefined_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                <h5><i class="icon fas fa-info"></i> Undefined!</h5>
                    <button type="button" class="sched_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning alert-dismissible">
                        <center><b>Student not enrolled in this school</b></center>
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
    <script>
        function onScanSuccess(decodedText, decodedResult) {
        var sound = new Audio("../includes/barcode.wav");
        // handle the scanned code as you like, for example:
        console.log(`Code matched = ${decodedText}`, decodedResult);

       
        getStudentRecord(decodedText);
       
        sound.play();
        html5QrcodeScanner.pause().then(_ => {
            // the UI should be cleared here    
        }).catch(error => {
            // Could not stop scanning for reasons specified in `error`.
            // This conditions should ideally not happen.
        });

    

        }

        function onScanFailure(error) {
        // handle scan failure, usually better to ignore and keep scanning
             console.warn(`Barcode error = ${error}`);
        }


        var config = {
        fps: 10,
        qrbox: {width: 500, height: 300},
        rememberLastUsedCamera: true,
        // Only support camera scan type.
        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        };

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", config, /* verbose= */ false);

        html5QrcodeScanner.render(onScanSuccess);

        function getStudentRecord(id){
            $.ajax({
                method: "get",
                dataType: "json",
                url: "../includes/student.inc.php?school_id=" + id,
                success: function (response){
                  
                // $.each(response, function(index, data) {
                //     console.log(data.last_name)
                //      
                //     });

                if(response.error == "Not Enrolled!"){
                    $('#undefined_student').modal('show')
                    console.log(response.error)

                    setTimeout(function(){
                        $('#undefined_student').modal('hide')
                    }, 2000);
                    const myTimeout = setTimeout(timeInterval, 4000);
                }
                else{
                $('.stud_name').html(response.first_name+' '+response.last_name+'.');
                // $('.stud_year').html(response.student_year);
                $('.stud_course').html(response.student_course + '-' + response.student_year);
                $('.stud_contact').html(response.phone);
                $('.stud_address').html(response.address);
                $('.time_in').html(response.status+' ('+ response.created_at+')');
                document.getElementById('student_preview').innerHTML = '<img class="rounded-circle" width="200" height="200" src="'+response.imageFile+'">';
                const myTimeout = setTimeout(timeInterval, 2000);
                }
              
                }
               
            })
        }

        function timeInterval() {
            html5QrcodeScanner.resume();
        }

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