<?php
  include "../classes/userContr.classes.php";
  include "../includes/subject_details.inc.php";


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
                        <a class="collapse-item" href="users.php">Sub-Admin</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
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
                <a class="nav-link" href="tables.html">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=  $name;?></span>
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
                              <center><h4><b><?= $subject['subject_name']; ?></b></h4>  </center><br>
                              <center><b><?= $subject['subject_description']; ?></b></center>
                              <center><p><?= $subject['subj_id']; ?> <i class="fas fa-network-wired"></i></p></center>
                              <hr>
                              <div class="container"> 
                              <div class="table-responsive">
                                <table class="table table-bordered table-secondary" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Professor Name</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            if($s == false){

                                            }
                                            else{
                                            foreach($s as $rm){ ?>
                                               <tr id="records_<?= $rm['id'];?>">
                                               <a href="#"><td><?= $rm['first_name'].' '.$rm['last_name']; ?></td><a>
                                                    <td> <?= $rm['email']; ?></td>
                                                    <td> <?= $rm['address']; ?></td>
                                                    <td>
                                                        <button type="button" onclick="addSchedule(<?= $rm['id'];?>, <?= $rm['subject_id']; ?>)" class="btn-sm btn-primary" data-toggle="tooltip" data-placement="top" title="assign schedule"><i class="fa fa-paperclip"></i></button>
                                                        <button type="button" onclick="deleteProf(<?= $rm['id'];?>, <?= $rm['subject_id']; ?>)" class="btn-sm btn-danger dlt_record" data-toggle="tooltip" data-placement="top" title="delete"><i class="fa fa-trash"></i></button>
                                                    </td>
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

     <!-- Assign Schedule to the subject -->
     <div class="modal fade" id="assignProfessor" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                 <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Scheduler</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger error_alert" role="alert">
                         <div class="error_div">

                         </div>
                    </div>
                    <div class="alert alert-success success_alert" role="alert">
                        <div class="success_div">
                                            
                         </div>
                    </div>
                    <div class="row  justify-content-center">
                        <div class="col">

                            <div class="accordion_schedules"></div>
                                            
                           
                        </div>
                        <div class="col">
                          
                            <div class="form-row justify-content-center">
                                    
                                          Add Schedule
                                </div>
                                <br>
                            <form method="post" id="myForm">
                               <div class="form-row justify-content-center">
                                    <div class="form-group">
                                        <label for="student_first_name">Room Number</label>
                                            <select class="selectpicker form-control" data-live-search="true" name="select_room" required>
                                                 <option>Select Room Number</option>
                                                <?php
                                                    
                                                
                                                    foreach( $ssd as $rooms ){ ?>
                                                    
                                                        <option value="<?=$rooms['id']?>"> <?= $rooms['room_number']; ?></option>
                                                        
                                                
                                                    <?php  
                                                    }
                                                
                                                ?>         
                                                            
                                            </select>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group">
                                        <label for="student_first_name">Time In</label>
                                        <input type="time" class="form-control" name="time_in" required>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group">
                                        <label for="student_first_name">Time Out</label>
                                        <input type="time" class="form-control" name="time_out" required>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="mon" value="mon" name="chkl[]">
                                        <label class="custom-control-label" for="mon">Monday</label>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="tues" value="tues" name="chkl[]">
                                        <label class="custom-control-label" for="tues">Tuesday</label>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="wed" value="wed" name="chkl[]">
                                        <label class="custom-control-label" for="wed">Wednesday</label>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="thurs" value="thurs" name="chkl[]">
                                        <label class="custom-control-label" for="thurs">Thursday</label>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center =">
                                    <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="fri" value="fri" name="chkl[]">
                                        <label class="custom-control-label" for="fri">Friday</label>
                                    </div>
                                </div>
                                <div class="form-row justify-content-center">
                                    <div class="form-group col-md-4">
                                        <input type="checkbox" class="custom-control-input" id="sat" value="sat" name="chkl[]">
                                        <label class="custom-control-label" for="sat">Saturday</label>
                                    </div>
                                </div>

                                <input type="hidden" name="prof_subj_id" id="prof_subj_id">
                                <input type="hidden" name="subj_uid" id="subj_uid">
                                <hr>
                                <div class="form-row justify-content-center">
                                    <div class="form-group">
                                        <button type="button" name="btn_schedule_submit" id="btn_schedule_submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>      
                        </div>
                       
                    </div>
                    <!-- <hr>
                    <div class="row justify-content-center">
                       <div class="table-responsive">
                        <center><h2>Schedules</h2></center>
                        <table class="table table-dark" id="tbl1" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Day</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="tbl1"> 
                                
                            </tbody>
                        </table>
                       </div>
                    </div> -->
                    
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
    
    $('#hide_me').hide();
    function addSchedule(id, subj_id){
        $('.error_alert').hide();
        $('.success_alert').hide();
        showAccordion(id, subj_id);
        schedules(id,subj_id);

        $('#prof_subj_id').val(id);
        $('#subj_uid').val(subj_id);
        $('#assignProfessor').modal();
    }

    $('#btn_schedule_submit').click(function (){
        var confirmation = confirm("Is the form filled out correctly?");

        if(confirmation){
            $.ajax({
            url: '../includes/subject_details.inc.php',
            type: 'post',
            dataType: 'json',
            data: $('form#myForm').serialize(),
            success: function(data) {
                schedules(data.prof_id,data.subj_id);
                if(data.error){
                    $('.error_div').html(data.error)
                    $( ".error_alert" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                }
                else{
                    showAccordion(data.prof_id,data.subj_id)
                    $('.success_div').html(data.success)
                    $( ".success_alert" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                }
            }
         });
        }
    
    })

    function schedules(id,subj_id){
        var html = '';
        var str = '';
        $.ajax({
                method: "get",
                dataType: "json",
                url: "../includes/subject_details.inc.php?prof_id="+ id +'&subj_id='+subj_id, 
                success: function (response){
                $.each(response, function(index, data) {
                    time = data.time;
                    html += '<tr class="schedule_record_'+data.id+'">';
                    html += '<td>'+data.subject_name+'</td>';
                    html += '<td>'+data.day+'</td>';
                    html += '<td>'+data.time_in+'</td>';
                    html += '<td>'+data.time_out+'</td>';
                    html += '<td><button class="btn btn-sm btn-danger" onclick="deleteSched('+data.id+','+id+','+subj_id+','+timeToDecimal(data.time_in)+')" id="delete_schedule"><i class="fa fa-trash"></i></button></td>';
                    html += '</tr>';
                });
                // for (var i = 0; i < response.length; ++i) {
                //     console.log(response[i].time_in);
                // }
                $('.tbl1').html(html);
            }
        })
    }

    function timeToDecimal(t) {
        var arr = t.split(':');
        var dec = parseInt((arr[1]/6)*10, 10);
        
        return parseFloat(parseInt(arr[0], 10) + '.' + (dec<10?'0':'') + dec);
    }   

    function deleteProf(id,subj_id){
        var confirmation = confirm("are you sure you want to remove professor in this subject?");

        if(confirmation){
            $.ajax({
                method: "get",
                url: "../includes/subject_details.inc.php?delete_prof="+ id +'&subj_id='+subj_id,
                success: function (response){
                $("#records_"+id).remove();
                }
            })
        }
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
                console.log(result);
                $(".accordion_schedules").html(result);
            }
        });
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