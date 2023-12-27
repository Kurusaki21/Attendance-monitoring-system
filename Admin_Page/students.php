<?php
  include "../classes/userContr.classes.php";
  include "../includes/student.inc.php";
  include "../includes/subject.inc.php";
//   require '../vendor/autoload.php';
  require_once __DIR__.'/../vendor/autoload.php';

  $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  $students = new StudentCntr();
  $list_of_students = $students->students();
if(isset($user)){
      
  $name = $user['first_name'].' '.$user['last_name'];
  $role = $user['role'];
  if(isset($role) == '1'){


?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js" rel="stylesheet">
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
    #preview{
        height: 100px;
        width: 100px;
    }
    #edit_preview{
        height: 100px;
        width: 100px;
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
                        <a class="collapse-item" href="users.php">Sub-Admin</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="subjects.php">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Subjects</span></a>
            </li>
            
            <li class="nav-item ">
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
                         <h4><b>Students Record</b></h4>  
                         <div class="row card-student ">
                            <div class="row col-sm-12">
                                 <button type="button" data-toggle="modal" data-target=".addStudent" class="btn btn-sm btn-primary" id="getstudentid">Add New Student</button>
                            </div>

                        </div>
                        <div class="admin-container">
                            <div class="admin-card">

                            <div class="table-responsive">
                            <table id="example-table" class="table table-striped table-bordered dt-responsive nowrap payment_table" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Shoold ID</th>
                                            <th>Student Photo</th>
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
                                                    <td> 
                                                            <?php echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($students['school_id'], $generator::TYPE_CODE_128)) . '">'; ?>
                                                      
                                                    </td>
                                                    <td align="center"><img src="<?=$students['imageFile'] ?>" width="50px" height="50px"> </td>
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
                    <a class="btn btn-primary" href="../includes/logout.php">Logout</a>
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
                    <form method="POST" action="../includes/student.inc.php" enctype="multipart/form-data">
                        <div class="form-group">
                         
                            <label for="student_email">Student ID</label>
                            <input type="text" class="form-control" name="stud_id">
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
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSEE">BSEE</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BEED">BEED</option>
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

                            <div class="form-group col-md-3">
                                 <label for="block">School Year</label>
                                 <input type="text" class="form-control" name="school_year" value="<?= $subject->getSchoolYear()['school_year']; ?>" readonly>
                            </div>

                            <div class="form-row col-md-12">
                                    <input type="file" name="item_photo" value=""  onchange="loadFile(event)">   <input type=button value="Take Snapshot" onClick="take_snapshot()">
                                    <div class="col-md-6">
                                    
                                        <br/>
                                  
                                        <input type="hidden" name="image" class="image-tag">
                                    </div>
                                 
                            </div>
                            <div class="form-row col-md-12">   <div id="my_camera"></div></div>
                            <div class="form-row col-md-12 ">
                                <img id="preview" src="#" /> 
                            </div>

                        </div>
                        <hr>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
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
                    <form method="POST" action="../includes/student.inc.php" enctype="multipart/form-data">
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
                                    <option value="BSIT">BSIT</option>
                                    <option value="BSEE">BSEE</option>
                                    <option value="BSBA">BSBA</option>
                                    <option value="BEED">BEED</option>
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

                            <div class="form-row col-md-12">
                                    <input type="file" name="item_photo" value=""  onchange="loadFile2(event)">
                                 
                            </div>
                            <div class="form-row col-md-12 ">
                                <img id="edit_preview" src="#" />
                            </div>

                                <input type="hidden" id = "student_id" name="student_id">
                        </div>
                        <hr>
                        <button type="submit" name="edit_submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <script src="../vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendor/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendor/jszip/dist/jszip.min.js"></script>
    <script src="../vendor/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendor/pdfmake/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <!-- Page level custom scripts -->

    <script tpye="application/javascript">

    

    var loadFile = function(event) {
    var output = document.getElementById('preview');
    output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
    var loadFile2 = function(event) {
    var output = document.getElementById('edit_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
    </script>
    <script>

$(document).ready(function () {
    // Setup - add a text input to each footer cell
    $('#example-table thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#example-table thead');
 
        var table = $('#example-table').DataTable({
          
            orderCellsTop: true,
            fixedHeader: true,
            
            initComplete: function () {
                var api = this.api();
    
                // For each column
                api
                    .columns(":not(:last-child)")
                    .eq(0)
                    .each(function (colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                        var title = $(cell).text();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');
    
                        // On every keypress in this input
                        $(
                            'input',
                            $('.filters th').eq($(api.column(colIdx).header()).index())
                        )
                            .off('keyup change')
                            .on('change', function (e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr = '({search})'; //$(this).parents('th').find('select').val();
    
                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != ''
                                            ? regexr.replace('{search}', '(((' + this.value + ')))')
                                            : '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function (e) {
                                e.stopPropagation();
    
                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'print',
                exportOptions: {
                    stripHtml : false,
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            visible: false
        } ]
        });
      });
       
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
                        $('#student_address').val(data.address)
                        $('#student_email').val(data.email)
                        $('#student_phone').val(data.parents_contact)
                    });
                }
               
            })
            $('#student_id').val(id);
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
    <script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot(e) {
        Webcam.snap( function(data_uri) {
           var img = $(".image-tag").val(data_uri);
            document.getElementById('preview').append('<img src="'+data_uri+'"/>');
            console.log(data_uri)
        } );
 
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