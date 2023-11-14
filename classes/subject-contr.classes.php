<?php

class SubjectCntr extends AddSubject{
    public function setSubject(){
        if(isset($_POST['btn_submit'])){
            $subject = $_POST['subject_name'];
            $subject_description = $_POST['subject_description'];
            $school_year = $_POST['school_year'];
            $school_sem = $_POST['school_sem'];

            $this->addSubject($subject, $subject_description, $school_year, $school_sem);
        }
    }

    public function setAssignProfessor(){
        if(isset($_POST['btn_submit_professor'])){
            $prof_id = $_POST['select_professor'];
            $subj_id = $_POST['subj_id'];
        }
        if($this->ifProfExist($prof_id, $subj_id) == true){
            header("location: ../admin_page/subjects.php?error=professor_already_assigned");
        }
        else{
            $this->addProfSubject($prof_id, $subj_id);
        }
 
    }

    public function updateSubject($subject, $subject_description ,$subj_id){
        $this->editSubject($subject, $subject_description ,$subj_id);
        return json_encode(array("statusCode"=>200));
    }

    public function subjects(){
        return $this->getSubjects();
    }

    public function subjectsProfessor(){
        return $this->getSubjectProfessor();
    }

    public function getSubjecttData($id){
        echo json_encode($this->subjectData($id));
    }

    public function deleteSubject($id){
        $this->removeSubject($id);
        return json_encode(array("statusCode"=>200));
    }

    public function selectProfessors(){
        echo json_encode($this->getProfessors());
    }

    public function ifProfExist($prof_id, $subj_id){
        $result;

        if($this->getProfessorExist($prof_id, $subj_id)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function showSubjectdata($id){
        return $this->getSubjectData($id);
    }
    public function getSubject($id){
        return $this->getSubjectId($id);
    }

    public function insertSchedule(){
         
            $room_id = $_POST['select_room'];
            $prof_id = $_POST['prof_subj_id'];
            $subj_id = $_POST['subj_uid'];
            $time_in = $_POST['time_in'];
            $time_out = $_POST['time_out'];
            $chkl = $_POST['chkl'];
            // if($this->matchDay($prof_id, $subj_id, $chkl, $time_in) == true){
            //     echo json_encode(array('error'=>'Schedule Already Exist', 'prof_id' => $prof_id, 'subj_id' => $subj_id));
            // }
            if($this->matchRoom($prof_id, $subj_id, $chkl, $time_in, $room_id) == true){
                echo json_encode(array('error'=>'Conflict of Schedule', 'prof_id' => $prof_id, 'subj_id' => $subj_id));
            }
            elseif($this->matchProf($prof_id, $subj_id, $chkl, $time_in, $room_id) == true){

            }
            else{
                echo json_encode($this->setSchedule($prof_id, $subj_id,$time_in, $time_out, $chkl, $room_id));
            }
        
    }

    public function getProfessorSchedule($prof_id, $subj_id){

       return $this->profSchedDetails($prof_id, $subj_id);
    }

    public function matchDay($prof_id, $subj_id, $chkl, $time_in){
        $result;

        if($this->validateSchedule($prof_id, $subj_id, $chkl,$time_in)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    public function matchRoom($prof_id, $subj_id, $chkl, $time_in, $room_id){
        $result;

        if($this->validateRoomAndTime($prof_id, $subj_id, $chkl,$time_in,$room_id)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    public function matchProf($prof_id, $subj_id, $chkl, $time_in, $room_id){
        $result;

        if($this->validateProfessorRoomAndTime($prof_id, $subj_id, $chkl,$time_in,$room_id)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    public function removeProfonSchedule($prof_id, $subj_id){
        return $this->removeAssignedProfessor($prof_id, $subj_id);
     
    }

    public function removeSchedule($prof_id, $subj_id, $time_in){

       return $this->removeSubjectProfessor($prof_id, $subj_id, $this->clockalize($time_in));
    }

    public function getStudents(){
        echo json_encode($this->studentsList());
    }

     function clockalize($in){

        $h = intval($in);
        $m = round((((($in - $h) / 100.0) * 60.0) * 100), 0);
        if ($m == 60)
        {
            $h++;
            $m = 0;
        }
        $retval = sprintf("%02d:%02d", $h, $m);
        return $retval;
    }

    public function insertStudentSchedule($student_id,$pro_id,$subj_id,$sched_subject){

        if($this->matchStudent($student_id, $sched_subject) == true){
            echo json_encode(array('error'=>'Student Already Added', 'student_id' => $student_id, 'sched_subject' => $sched_subject));
        }
        else{
            echo json_encode($this->insertStudents($student_id,$pro_id,$subj_id,$sched_subject));
        }
       
    }

    public function matchStudent($student_id, $sched_subject){
        $result;

        if($this->validateStudent($student_id, $sched_subject)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    public function students($getscheduleid){
        echo json_encode($this->studentsData($getscheduleid));
    }

    public function delStudent($id){
        return $this->deleteAssignedStudent($id);
    }

    
    public function decimalHours($time)
    {
        $hms = explode(":", $time);
        return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
    }

    public function insertRoomNumber($room_no){
        echo $this->insertRoom($room_no);
    }

    public function getAllRooms(){
        return $this->returnRooms();
    }

    public function deleteRoom($id){
        echo $this->deleteThisRoom($id);
    }

    public function showAllRooms(){
        return $this->allRooms();
    }

    public function addSchoolyear($school_year){
        return $this->setSchoolyear($school_year);
    }

    public function getSchoolYear(){
        return $this->getCurrentSchoolYear();
    }
}


?>