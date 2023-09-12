<?php 

class ProfessorCntr extends Professor{

    public function setProfessor(){
        if(isset($_POST['submit'])){
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];

           $this->addProf($fname, $lname, $email,  $address, $password);
        }
    }

    public function setEdit(){
        if(isset($_POST['edit_submit'])){
            $id = $_POST['prof_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];

           $this->editProfessor($id, $fname, $lname, $email,  $address);
        }
    }

    public function Professor(){
        return $this->getProfessor();
    }

    public function getProfessorData($id){
        echo json_encode($this->professorData($id));
    }

    public function deleteProf($id){
        $this->removeProf($id);
        return json_encode(array("statusCode"=>200));
    }

    public function getProfessorSchedules($id){
        return $this->profSchedDetails($id);
    }

    public function getSchedule($ids, $date){
        return $this->schedule($ids, $date);
    }

    public function StudentAttendance($school_id, $subject_id){
        $time = date("H:i:s");
        $time_in = $this->getTimeSchedule($subject_id)['time_in'];
        $time_out = $this->getTimeSchedule($subject_id)['time_out'];
        $newTime = date('H:i:s', strtotime($time_in. ' +15 minutes'));
        if($this->attendanceExist($this->getStudentData($school_id)['id'],$this->getSchedulData($subject_id)['prof_id'], $subject_id ) == false){
            if ($time >= $newTime) {
                return $this->setStudentAttendance($this->getStudentData($school_id)['id'], $this->getSchedulData($subject_id)['prof_id'], $subject_id, 0);
            
            }
            else{
                return $this->setStudentAttendance($this->getStudentData($school_id)['id'], $this->getSchedulData($subject_id)['prof_id'], $subject_id, 1);
            }
        }
        else{
            echo json_encode(array("error" => "404"));
        }
       // return $this->attendanceExist($this->getStudentData($school_id)['id'],$this->getSchedulData($subject_id)['prof_id'], $subject_id );
    }
    //get the student id
    public function getStudentData($school_id){
        return $this->studentId($school_id);
    }
    //get the professor id
    public function getSchedulData($subject_id){
        return $this->professorId($subject_id);
    }
    //get the time schedule
    public function getTimeSchedule($subject_id){
        return $this->getTime($subject_id);
    }

    public function attendanceExist($student_id, $prof_id, $subject_id){
        $result;

        if($this->checkAttendance($student_id, $prof_id, $subject_id)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;

     //  echo $this->checkAttendance($student_id, $prof_id, $subject_id);
    }

   


}