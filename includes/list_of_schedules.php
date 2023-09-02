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
                            <input type="text" value="<?= $_POST['prof_id'] ?>" id="sub_prof_id">
                            <input type="text" value="<?= $_POST['subject_id'] ?>" id="sub_id">
                            <input type="text" value="<?= $data['ids'] ?>" id="sched_subject">
                            <select class="selectpicker form-control my-select-student" id="my-select-student_<?= $data['id']; ?>" data-live-search="true" name="select_professor">
                         
                            </select>
                    </div>
                <div class="container">
                <div class="table-responsive">
                                <table class="table table-stripped" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>School ID</th>
                                            <th>Full Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                        </tr>
                                        
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
           var pro_id = $('#sub_prof_id').val();
           var subj_id = $('#sub_id').val();
           var sched_subject = $('#sched_subject').val();
           console.log(pro_id)
           console.log(subj_id)
           console.log(sched_subject)
        })


$('.my-select-student').selectpicker();
// $('#add_button').click(function(){
//     $('#add_button').hide();
// })
// $('#hidden_button').click(function(){
//     $('#hide_me').hide();

//     $('#hidden_button').hide();
// })
function showData(prof_id, subj_id,id){
    $('#hide_me_'+id+'').hide();
    $('#hidden_button_'+id+'').hide();
    $('#add_button_'+id+'').show();
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
                $(this).append('<option value='+response[i]['id']+'>'+response[i]['first_name']+' '+response[i]['last_name']+'</option>');
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
    
}
function hide_button_function(id){
    $('#add_button_'+id+'').show();
    $('#hide_me_'+id+'').hide();
    $('#hidden_button_'+id+'').hide();
}
</script>