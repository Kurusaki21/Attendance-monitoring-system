<?php
  include "../classes/userContr.classes.php";
  include "../includes/student.inc.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  $students = new StudentCntr();
  $list_of_students = $students->students();
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
            <li class="nav-item active">
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

            <li class="nav-item">
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
                         <h4><b>Students Record</b></h4>  
                         <div class="row card-student ">
                            <div class="row col-sm-12">
                                 <button type="button" data-toggle="modal" data-target=".addStudent" class="btn btn-sm btn-primary" id="getstudentid">Add New Student</button>
                            </div>

                        </div>
                        <div class="admin-container">
                            <div class="admin-card">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Guardian Phone Number</th>
                                            <th>Year</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                            if($list_of_students == false){

                                            }
                                            else{
                                            foreach($list_of_students as $students){ ?>
                                               <tr id="records_<?= $students['id'];?>">
                                                    <td> <?= $students['first_name'].' '.$students['last_name']; ?></td>
                                                    <td> <?= $students['email']; ?></td>
                                                    <td> <?= $students['address']; ?></td>
                                                    <td> <?= $students['parents_contact']; ?></td>
                                                    <td> <?= $students['student_year']; ?></td>
                                                    <td> <?= $students['student_course']; ?></td>
                                                    <td><button type="button" data-toggle="tooltip" data-placement="top" title="edit" onclick="editStudentModal(<?= $students['id'];?>)" class="btn btn-sm btn-success"><i class="far fa-edit"></i></button> <button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="show student's profile"><i class="fas fa-eye"></i></i></button> <button type="button" onclick="deleteUser(<?= $students['id'];?>)" class="btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>
                                                </tr>
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
                    <a class="btn btn-primary" href="../login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Student Modal -->
    <div class="modal fade addStudent" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../includes/student.inc.php">
                        <div class="form-group">
                            <label for="student_email">Student ID</label>
                            <input type="text" class="form-control" name="stud_id" id='school_id' readonly>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="student_first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" placeholder="first name">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="student_last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" placeholder="last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="student_email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="student_address">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="address">
                        </div>
                        <div class="form-group">
                            <label for="student_phone">Parents Phone Number</label>
                            <input type="number" class="form-control" name="phone" placeholder="phone number">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                
                                <label for="inputState">Select Course</label>
                                <select class="custom-select" name="course">
                                    <optgroup label="Department of Computer and Engineering">
                                        <option value="CpE">Computer Engineering</option>
                                        <option value="IT">Information Technology</option>
                                        <option value="CS">Copmuter Science</option>
                                    </optgroup>
                                    <optgroup label="Department of Education">
                                        <option value="Educ">Education</option>
                                    </optgroup>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="year" >Year</label>

                                <select class="custom-select" name="year">
                                    <option value="1">1st year</option>
                                    <option value="2">2nd year</option>
                                    <option value="3">3rd year</option>
                                    <option value="4">4th year</option>
                                </select>
                                
                            </div>

                            <div class="form-group col-md-2">
                                 <label for="block">Block</label>
                                 <select class="custom-select"  name="block">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>

                        </div>
                        <hr>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Student Modal -->
    <div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../includes/student.inc.php">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="student_first_name">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="student_first_name" placeholder="first name">
                            </div>
                            <div class="form-group col-md-6">
                            <label for="student_last_name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="student_last_name" placeholder="last name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="student_email">Email</label>
                            <input type="email" class="form-control" name="email" id="student_email" placeholder="email">
                        </div>
                        <div class="form-group">
                            <label for="student_address">Address</label>
                            <input type="text" class="form-control" name="address" id="student_address" placeholder="address">
                        </div>
                        <div class="form-group">
                            <label for="student_phone">Parents Phone Number</label>
                            <input type="number" class="form-control" name="phone" id="student_phone" placeholder="phone number">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                
                                <label for="inputState">Select Course</label>
                                <select class="custom-select" name="course">
                                    <optgroup label="Department of Computer and Engineering">
                                        <option value="CpE">Computer Engineering</option>
                                        <option value="IT">Information Technology</option>
                                        <option value="CS">Copmuter Science</option>
                                    </optgroup>
                                    <optgroup label="Department of Education">
                                        <option value="Educ">Education</option>
                                    </optgroup>
                                </select>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="year" >Year</label>

                                <select class="custom-select" name="year">
                                    <option value="1">1st year</option>
                                    <option value="2">2nd year</option>
                                    <option value="3">3rd year</option>
                                    <option value="4">4th year</option>
                                </select>
                                
                            </div>

                            <div class="form-group col-md-2">
                                 <label for="block">Block</label>
                                 <select class="custom-select"  name="block">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </div>

                        </div>
                        <hr>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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

    <!-- Page level custom scripts -->
    <script src="../js/demo/datatables-demo.js"></script>
    <script>
      $(document).on('click', '#getstudentid', function () {
        const d = new Date();
        let year = d.getFullYear();
            $.ajax({
                    method: "get",
                    dataType: "json",
                    url: "../includes/student.inc.php?get_school_id=" + year,
                    success: function (response){
                    $.each(response, function(index, data) {
               

                           var databasevalue = data;
                           var incrementvalue = (+databasevalue) + 1;
                           incrementvalue = ("000000000" + incrementvalue).slice(-9);
                           $('#school_id').val(incrementvalue);
                    });
                }
            })
        });
    

        function editStudentModal(id){
            $.ajax({
                method: "get",
                dataType: "json",
                url: "../includes/student.inc.php?id=" + id,
                success: function (response){
                $.each(response, function(index, data) {
                        $('#student_first_name').val(data.first_name)
                        $('#student_last_name').val(data.last_name)
                        $('#student_email').val(data.address)
                        $('#student_address').val(data.email)
                        $('#student_phone').val(data.parents_contact)
                    });
                }
            })
            $('#editStudent').modal(); 
        }

        function deleteUser(id){
            var confirmation = confirm("are you sure you want to remove the item?");

            if(confirmation){
                $.ajax({
                    method: "get",
                    url: "../includes/student.inc.php?delete_user=" + id,
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