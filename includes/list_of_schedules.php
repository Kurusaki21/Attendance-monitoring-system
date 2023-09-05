<?php
include 'subject_details.inc.php';

if(isset($_POST['prof_id']) && isset($_POST['subject_id'])){
    $s = $subject_details->getProfessorSchedule($_POST['prof_id'], $_POST['subject_id']);
    
}



?>
<?php foreach($s as $data){
?>

   <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" onclick="showData(<?= $_POST['prof_id'].','.$_POST['subject_id'].','.$data['id']; ?>)" data-target="#collapse_<?= $data['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                <?= $data['day'].' | '.$data['time_in'].'-'.$data['time_out']; ?>
                </button>
            </h5>
            </div>

            <div id="collapse_<?= $data['id']; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
            <div class="card-body">
                    <div class="col">
                        <button class="add_button" onclick='add_button_function(<?= $data['id']; ?>)' id="add_button_<?= $data['id']; ?>"><span>Add Student</span></button>
                        <button class="add_button btn-danger" onclick='hide_button_function(<?= $data['id']; ?>)' id="hidden_button_<?= $data['id']; ?>"><span>Close</span></button>
                    </div>
                    <div class="col" id="hide_me_<?= $data['id']; ?>"> 
                            <input type="hidden" value="<?= $_POST['prof_id'] ?>" id="sub_prof_id">
                            <input type="hidden" value="<?= $_POST['subject_id'] ?>" id="sub_id">
                            <input type="hidden" value="<?= $data['ids']; ?>"class="sched_subject" id="sched_subject_<?= $data['id']?>">
                            <select class="selectpicker form-control my-select-student" id="my-select-student_<?= $data['id']; ?>" data-live-search="true" name="select_professor">
                         
                            </select>
                    </div>
                <div class="container">
                <div class="table-responsive">
                                <table class="table table-stripped schedules_table_<?= $data['id']; ?>" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>School ID</th>
                                            <th>Full Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                </div>
            </div>
            </div>
        </div>
    </div>  
<?php
}
?>

<script>

        $(".my-select-student").change(function(e){
           var student_id = this.value;
           var pro_id = $('#sub_prof_id').val();
           var subj_id = $('#sub_id').val();
           var id = $(this).children(":selected").attr("id");
           console.log(id);
        
           $.ajax({
                type: "post",
                dataType: "json",
                url: "../includes/subject_details.inc.php", 
                data:{
                    student_id: student_id,
                    pro_id: pro_id,
                    subj_id: subj_id,
                    sched_subject: id,
                    action_submit: 'assign_student'
                },
                success: function (response){
                    if(response.error){
                     
                        $('.error_div').html(response.error)
                        $( ".error_alert" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                    }
                    else{
                        $('.success_div').html(response.success)
                        $( ".success_alert" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
                    }
                    listofStudents(pro_id, subj_id, id);
                    console.log(response);
                },
                error: function( error ){
                    console.log(error)
                }
            })

        

        })


$('.my-select-student').selectpicker();

function showData(prof_id, subj_id,id){
    $('#hide_me_'+id+'').hide();
    $('#hidden_button_'+id+'').hide();
    $('#add_button_'+id+'').show();

    
    listofStudents(id);
}

function listofStudents(id){
    var html='';
    $.ajax({
        type: "post",
        dataType: "json",
        url: "../includes/subject_details.inc.php?getscheduleid="+id, 
        success: function (response){
            $.each(response,function(index,value){
                html +='<tr>';
                html +='<td>'+ value.school_id + '</td>';
                html +='<td>'+ value.first_name +' '+ value.last_name+ '</td>';
                html +='<td><button class="btn btn-sm btn-danger" onclick="deleteAssignedStudent('+value.student_id+', '+id+')"><i class="fa fa-trash"></i></button></td>';
                html +='</tr>';
            });
            $('.schedules_table_'+id+' tbody').html(html);
        },
        error: function( error ){
            console.log(error)
        }
    })
}
function add_button_function(id){
    html='';
    $.ajax({
        type: "post",
        dataType: "json",
        url: "../includes/subject_details.inc.php", 
        data: {action: 'getstudent'},
        success: function (response){

        $('#my-select-student_'+id+'').on('show.bs.select', function() {
            $(this).html('');
            $(this).append('   <option></option>');
            html += '<option>Select Student</option>';
            for (var i = 0; i < response.length; i++) {
                $(this).append('<option id="'+id+'" value='+response[i]['id']+'>'+response[i]['first_name']+' '+response[i]['last_name']+'</option>');
            }
        $('.my-select-student').selectpicker('refresh');
            })
        },
        error: function( error ){
            console.log(error)
        }
    })
    $('#hide_me_'+id+'').show();
    $('#hidden_button_'+id+'').show();
    $('#add_button_'+id+'').hide();
    // $('#sched_subject_'+id+'').val(id)
    
}
function hide_button_function(id){
    $('#add_button_'+id+'').show();
    $('#hide_me_'+id+'').hide();
    $('#hidden_button_'+id+'').hide();
}

function deleteAssignedStudent(id,schedule_id){
    var confirmation = confirm("are you sure you want to remove professor in this subject?");

if(confirmation){
    $.ajax({
        method: "get",
        url: "../includes/subject_details.inc.php?delete_student="+id,
        success: function (response){
            listofStudents(schedule_id)
        }
    })
}
}


</script>