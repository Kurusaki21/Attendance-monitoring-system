<?php
  include "../classes/userContr.classes.php";
  include "../includes/users.inc.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();


$list_of_users = $users->getListofUsers();

if(isset($user)){
      
  $name = $user['first_name'].' '.$user['last_name'];
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

                <li class="nav-item ">
                    <a class="nav-link" href="index.php">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Dashboard</span></a>
                </li>
                <?php if($user['account_setting'] == 1){ ?>
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
                <?php }
                else{
                    echo '';
                }
                ?>

                <?php if($user['subject_setting'] == 1){ ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="subjects.php">
                            <i class="fas fa-fw fa-clipboard"></i>
                            <span>Subjects</span></a>
                    </li>
                <?php }
                else{
                    echo '';
                }
                ?>

                <?php if($user['records_setting'] == 1){ ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="records.php">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Records</span></a>
                    </li>
                <?php }
                else{
                    echo '';
                }
                ?>

                <!-- Nav Item - Tables -->
                <?php if($user['sms_setting'] == 1){ ?> 
                    <li class="nav-item">
                        <a class="nav-link" href="sms.php">
                            <i class="fas fa-fw fa-sms"></i>
                            <span>SMS</span></a>
                    </li>
                <?php }
                else{
                    echo '';
                }
                ?>

                <?php if($user['barcode_setting'] == 1){ ?>     
                <li class="nav-item">
                    <a class="nav-link" href="barcode.php">
                        <i class="fas fa-fw fa-sms"></i>
                        <span>Barcode Scanner</span></a>
                </li>
                <?php }
                else{
                    echo '';
                }
                ?>

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
                         <h4><b>Students Record</b></h4>  
                         <div class="row card-student ">
                            <div class="row col-sm-12">
                                 <button type="button" data-toggle="modal" data-target=".addUser" class="btn btn-sm btn-primary">Add User</button>
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         
                                         <?php
                                            if($list_of_users == false){

                                            }
                                            else{
                                            foreach($list_of_users as $sd){ ?>
                                               <tr id="records_<?= $sd['id'];?>">
                                                    <td> <?= $sd['first_name'].' '.$sd['last_name']; ?></td>
                                                    <td> <?= $sd['email']; ?></td>
                                                    <td> <?= $sd['address']; ?></td>
                                                    <td><button type="button" data-toggle="tooltip"   <?php if($user['role'] == '2'){ echo 'disabled ';} ?>  data-placement="top" title="edit" onclick="editProfessorModal(<?= $sd['id'];?>)" class="btn btn-sm btn-success"><i class="far fa-edit"></i></button>  <button type="button" onclick="deleteUser(<?= $sd['id'];?>)" class="btn-sm btn-danger dlt_record" <?php if($user['role'] == '2'){ echo 'disabled ';} ?> data-toggle="tooltip" data-placement="top" title="delete subject"><i class="fa fa-trash"></button></td>
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
                    <a class="btn btn-primary" href="../includes/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->
     <div class="modal fade addUser" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="../includes/users.inc.php">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="Name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="user_email">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user_email">Password</label>
                            <input type="password" class="form-control" name="password" id="user_password">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" id="prof_confirm_password">
                        </div>
                        <p id="conpasscheck" style="color: red;"></p>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="email" class="form-control" name="email" id="user_email">
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address</label>
                            <input type="text" class="form-control" name="address" id="user_address">
                        </div>
                        <label for="user_email">Restriction</label>

                            <div class="form-group col-md-6 ml-3">
                               
                                <input type="checkbox" class="custom-control-input" id="account_sttngs" value="account_sttngs" name="subadmin_sttngs[]">
                                <label class="custom-control-label" for="account_sttngs">Account Settings</label>
                            </div>

                           <div class="form-group col-md-6 ml-3">
                              
                                <input type="checkbox" class="custom-control-input" id="subject_sttngs" value="subject_sttngs" name="subadmin_sttngs[]">
                                <label class="custom-control-label" for="subject_sttngs">Subjects</label>
                            </div>

                            <div class="form-group col-md-6 ml-3">
                              
                                <input type="checkbox" class="custom-control-input" id="records_sttngs" value="records_sttngs" name="subadmin_sttngs[]">
                                <label class="custom-control-label" for="records_sttngs">Records</label>
                            </div>


                            <div class="form-group col-md-6 ml-3">
                               
                                <input type="checkbox" class="custom-control-input" id="sms_sttngs" value="sms_sttngs" name="subadmin_sttngs[]">
                                <label class="custom-control-label" for="sms_sttngs">SMS</label>
                          
                            </div>


                            <div class="form-group col-md-3 ml-3">
                                <input type="checkbox" class="custom-control-input" id="barcode_sttngs" value="barcode_sttngs" name="subadmin_sttngs[]">
                                <label class="custom-control-label" for="barcode_sttngs">Barcode</label>
                            </div>
                                
                       
                        <button type="submit" name="submit" id="btn_submit" class="btn btn-primary">Submit</button>
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