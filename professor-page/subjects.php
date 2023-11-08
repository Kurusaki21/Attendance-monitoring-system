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
<style>
    .add_button {
    border-radius: 4px;
    background-color: #5ca1e1;
    border: none;
    color: #fff;
    text-align: center;
    font-size: 10px;
    width:100px;
    transition: all 0.5s;
    cursor: pointer;
    }
 
    .add_button{
    cursor: pointer;
    display: inline-block;
    position: relative;
    transition: 0.5s;
    }
    select{
		font-family: fontAwesome
	}
    .add_button:after {
    content: '+';
    position: absolute;
    opacity: 0;  
    right: -20px;
    transition: 0.5s;
    }
    .add_button:after {
    content: '+';
    position: absolute;
    opacity: 0;  
    right: -20px;
    transition: 0.5s;
    }

    .add_button:hover{
    padding-right: 20px;
    padding-left:-5px;
    }

    .add_button:hover:after {
    opacity: 1;
    right: 10px;
    }
</style>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

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
                                <h4><b>Subjects and Schedules</b></h4>   <br> 
                               
                                <div class="row d-flex">
                                    <div class="col-sm-12 mb-4">
                                      <div class="card">
                                        <div class="card-body">

                                            <div class="row d-flex justify-content-center">
                                                <div class="col-sm-3">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Subject Name</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                       foreach( $prof->getProfessorSubject($id) as $subjects){
                                                                        ?>
                                                                        <tr>
                                                                            <td><a href="#" onclick="showSchedules(<?= $subjects['id']?>,<?= $id?>)" class="subjectid_<?= $subjects['id'] ?>"> <?= $subjects['subject_name']?></a></td>
                                                                        </tr>

                                                                    <?php
                                                                       }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div>
                                                    </div>
                                                 </div>

                                                 <div class="col-sm-9">
                                                    <div class="card">
                                                        <div class="card-body hide_me_card">
                                                            <div class="alert alert-danger error_alert" role="alert">
                                                                <div class="error_div">

                                                                </div>
                                                            </div>
                                                            <div class="alert alert-success success_alert" role="alert">
                                                                <div class="success_div">
                                                                                    
                                                                </div>
                                                            </div>
                                                               <div class="accordion_schedules_professor">
                                                                
                                                               </div>
                                                        </div>
                                                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script>
        $('.hide_me_card').hide();
        $('.my-select1').selectpicker();
        $('.error_alert').hide();
        $('.success_alert').hide();
        function showSchedules(id, prof_id){
            showAccordion(prof_id,id)
        }

        function showAccordion(id,subj_id){
        $.ajax({
            type: "POST",
            data: {
                prof_id: id,
                subject_id: subj_id
            },
            url: "../includes/list_of_schedules.php",
            success: function(result) {
                 $('.hide_me_card').show();
                $(".accordion_schedules_professor").html(result);
            }
        });
    }

        
        function onScanSuccess(decodedText, decodedResult) {
        var sound = new Audio("../includes/barcode.wav");
        setInterval(getStudentRecord(decodedText), 5000);
        sound.play();
        }

        var config = {
        fps: 10,
        qrbox: {width: 300, height: 300},
        rememberLastUsedCamera: true,
        // Only support camera scan type.
        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
        };

        let html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", config, /* verbose= */ false);

        html5QrcodeScanner.render(onScanSuccess);

        function getStudentRecord(id){
            var subject_id = $('#prof_id').val();
            $.ajax({
                method: "get",
                dataType: "json",
                url: "../includes/professor.inc.php?school_id=" + id+'&subj_id='+subject_id,
                success: function (response){
                    $.each(response, function(index, data) {
                        if(data == 404){
                            $('#is_present_professor').modal('show')

                            setTimeout(function(){
                                $('#is_present_professor').modal('hide')
                            }, 2000);
                        }
                        else{
                            $('.stud_name_professor').html(data.first_name+' '+data.last_name);
                            $('.stud_year_professor').html(data.student_year);
                            $('.stud_course_professor').html(data.student_course);
                            document.getElementById('student_preview_professor').innerHTML = '<img class="rounded-circle" width="200" height="200" src="'+data.imageFile+'">';
                        }
                          
                    });
                }
            })
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