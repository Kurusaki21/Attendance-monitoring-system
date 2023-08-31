<?php
  include "../classes/userContr.classes.php";
  include "../includes/subject.inc.php";
  include "../includes/professor.inc.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  $subject = new SubjectCntr();
  $subjectlist = $subject->subjects();

  $professors =  new ProfessorCntr();
  $list_of_professors = $professors->Professor();

if(isset($user)){
      
  $name = $user['name'];
  $role = $user['role'];
  if(isset($role) == '1'){


?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<style>
    .dashboard-image1{
      position: absolute;
      margin-top: -70px;
      z-index: 999999;
      margin-left:1em;
    }
    .card-student{
        width: 100%;
        justify-content: center;
        margin: 10px;
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
                                <small>Administrator</small>
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
                        <a class="collapse-item" href="users.php">Users</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="subjects.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Subjects</span></a>
            </li>
            
            <li class="nav-item ">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Records</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-sms"></i>
                    <span>SMS</span></a>
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
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
                         <h4><b>Subjects</b></h4>  
                         <div class="row card-student ">
                         <div class="row col-sm-12">
                                 <button type="button" data-toggle="modal" data-target=".addSubject" class="btn btn-sm btn-primary">New Subject</button>
                            </div>

                        </div>
                        <div class="admin-container">
                            <div class="admin-card">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Subject Name</th>
                                            <th>Description</th>
                                            <th>Professor Assigned</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                            if($subjectlist == false){

                                            }
                                            else{
                                            foreach($subjectlist as $subjects){ ?>
                                                <tr id="records_<?= $subjects['id'];?>">
                                                <td> <?= $subjects['subject_name']; ?></td>
                                                <td> <?= $subjects['subject_description']; ?></td>
                                                
                                                <td><?= $subjects['subj_id'];?></td>
                                                <td><button type="button" data-toggle="tooltip" data-placement="top" title="edit" onclick="editSubjectModal(<?= $subjects['id'];?>)" class="btn btn-sm btn-success"><i class="far fa-edit"></i></button> <a href="show-assigned-professor.php?subject_id=<?= $subjects['id'];?>" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="show assigned professors"><i class="fas fa-eye"></i></i></a> <button class="btn btn-sm btn-warning" data-toggle="tooltip" onclick="assignProfessorModal(<?= $subjects['id'];?>)" data-placement="top" title="assign professor"><i class="fas fa-network-wired"></i></button> <button type="button" onclick="deleteSubject(<?= $subjects['id'];?>)" class="btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>
                                            <?php  
                                            }
                                            }
                                        ?>

                                    </tbody>
                                </table>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Subject Modal -->
    <div class="modal fade addSubject" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../includes/subject.inc.php">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="student_first_name">Subject Name</label>
                                <input type="text" class="form-control" name="subject_name" placeholder="subject name">
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" name="subject_description" rows="3" placeholder="subject description"></textarea>
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6">
                                <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Subject Modal -->
    <div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="student_first_name">Subject Name</label>
                                <input type="text" class="form-control" name="subject_name" id="subject_name" placeholder="subject name">
                            </div>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlTextarea1">Description</label>
                                <textarea class="form-control" id="subject_description" name="subject_description" rows="3" placeholder="subject description"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="subj_id" id="subj_id">
                        <div class="form-row justify-content-center">
                            <div class="form-group col-md-6">
                                <button type="submit" name="edit_subject" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Assign Professor Modal -->
     <div class="modal fade" id="assignProfessor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Professor</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../includes/subject.inc.php">
                    <div class="form-group">
                        <label for="firstName">Name</label>
                        
                            <select class="selectpicker form-control" data-live-search="true" name="select_professor">
                                            <option>Select Professor</option>
                            <?php
                                if($list_of_professors == false){

                                }
                                else{
                                foreach($list_of_professors as $professors){ ?>
                                   
                                        <option value="<?=$professors['id']?>"> <?= $professors['first_name'].' '.$professors['last_name']; ?></td>
                                      
                            
                                <?php  
                                }
                                }
                            ?>         
                                            
                            </select>
                  
                    </div>
                        <input type="hidden" name="subj_id" id="subj_prof_id">
                         <div class="form-group">
                            <div class="form-group col-md-6">
                                <button type="submit" name="btn_submit_professor" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                       
                    </form>
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

    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script>
        $('.my-select').selectpicker();
        function editSubjectModal(id){
            $.ajax({
                method: "get",
                dataType: "json",
                url: "../includes/subject.inc.php?id=" + id,
                success: function (response){
                $.each(response, function(index, data) {
                        $('#subject_name').val(data.subject_name)
                        $('#subject_description').val(data.subject_description)
                        $('#subj_id').val(data.id)
                    });
                }
            })
            $('#editSubject').modal(); 
        }

        function assignProfessorModal(id){
            // $.ajax({
            //     method: "get",
            //     dataType: "json",
            //     url: "../includes/subject.inc.php?id=" + id,
            //     success: function (response){
            //     $.each(response, function(index, data) {
            //             $('#subject_name').val(data.subject_name)
            //             $('#subject_description').val(data.subject_description)
            //         });
            //     }
            // })
            $('#subj_prof_id').val(id);
            $('#assignProfessor').modal(); 
        }

        function deleteSubject(id){
            var confirmation = confirm("are you sure you want to remove this subject?");

            if(confirmation){
                $.ajax({
                    method: "get",
                    url: "../includes/subject.inc.php?delete_user=" + id,
                    success: function (response){
                    $("#records_"+id).remove();
                    }
                })
            }
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