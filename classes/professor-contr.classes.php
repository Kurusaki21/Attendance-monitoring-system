<?php 

class ProfessorCntr extends Professor{

    public function setProfessor(){
        if(isset($_POST['submit'])){
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $school_year = $_POST['school_year'];

           $this->addProf($fname, $lname, $email,  $address, $password, $school_year);
        }
    }

    public function setEdit(){
        if(isset($_POST['edit_submit'])){
            $id = $_POST['prof_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['confirm_password'];
            $address = $_POST['address'];

           $this->editProfessor($id, $fname, $lname, $email,$password,  $address);
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
       
        if($this->checkStudent($this->getStudentData($school_id)['id'],$this->getSchedulData($subject_id)['prof_id'], $subject_id ) == false){
            echo json_encode(array("error" => "400"));   
        }
        else{
            if($this->attendanceExist($this->getStudentData($school_id)['id'],$this->getSchedulData($subject_id)['prof_id'], $subject_id ) == true){
                echo json_encode(array("error" => "404"));
            }
            else{
              
                if ($time <= $newTime) {
                    return $this->setStudentAttendance($this->getStudentData($school_id)['id'], $this->getSchedulData($subject_id)['prof_id'], $subject_id, 0);
               
               
               }
               else{
                    return $this->setStudentAttendance($this->getStudentData($school_id)['id'], $this->getSchedulData($subject_id)['prof_id'], $subject_id, 1);
                
               }
            }
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

        if($this->checkAttendance($student_id, $prof_id, $subject_id) == true){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;

     //  echo $this->checkAttendance($student_id, $prof_id, $subject_id);
    }

    public function getProfessorSubject($id){
        return $this->professorSubject($id);
    }

    public function checkEnrolledStudent($student_id, $prof_id, $subject_id){
        $result;

        if($this->checkStudent($student_id, $prof_id, $subject_id) == 0){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    public function getAllStudentRecords($id){
        return $this->records($id);
    }
   public function countStudentsAttndance($id){
    return $this->countRecords($id);
   }
   public function countAllStudents($id){
    return $this->countStudents($id);
   }

}