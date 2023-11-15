<?php 

class AddSubject extends DB{
    protected function addSubject($subject_name, $subject_description, $school_year, $school_sem){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO subject (subject_name, subject_description,school_year, semester, created_at) VALUES (?,?,?,?,?)');

        if(!$stmt->execute([$subject_name, $subject_description, $school_year, $school_sem, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/subjects.php?success=1");
        
    }
    protected function getSubjects(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject.id,count(subject_professor.subject_id) as subj_id, subject.subject_name, subject.subject_description FROM subject LEFT JOIN subject_professor ON subject.id = subject_professor.subject_id WHERE school_year = '".$this->getCurrentSchoolYear()['school_year']."'GROUP BY subject.id");
        $stmt->execute();
        $subjects = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $subjects;
        }
        else{
            return false;
        }
    }

    protected function subjectData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM subject WHERE id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
        
    }

    protected function removeSubject($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM subject WHERE id = ?");
        $stmt->execute([$id]);
    }

    protected function editSubject($subject, $subject_description ,$subj_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE subject SET subject_name = ?, subject_description = ? WHERE id = ?");
        $stmt->execute([$subject, $subject_description,  $subj_id]);
    }

    protected function addProfSubject($prof_id, $subj_id){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("INSERT INTO subject_professor (professor_id, subject_id, created_at) VALUES (?,?,?) ");
        if(!$stmt->execute([$prof_id, $subj_id,$datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/subjects.php?success=1");
    }

    protected function getProfessorExist($prof_id, $subj_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM subject_professor WHERE professor_id = ? AND subject_id = ?");

        if(!$stmt->execute([$prof_id, $subj_id])){
            $stmt = null;

            header("location: index.php?errors=stmtfailed");
            exit();
        }
        $resultCheck;

        if($stmt->rowCount() == 0 ){
            $resultCheck = true;
        }
        else{
            $resultCheck = false;
        }
        return $resultCheck;
    }

    protected function getSubjectData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT professors.id,professors.first_name, professors.last_name, professors.email, professors.address, subject.subject_name, subject.subject_description,subject.id as subject_id, (SELECT count(subject_id) FROM subject_professor WHERE subject_id = $id) as subj_id FROM subject_professor LEFT JOIN professors ON subject_professor.professor_id = professors.id LEFT JOIN subject ON subject.id = subject_professor.subject_id WHERE subject_professor.subject_id = $id GROUP BY professors.id");
        $stmt->execute();

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function getSubjectId($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject.subject_name, subject.subject_description,(SELECT count(subject_id) FROM subject_professor WHERE subject_id = $id) as subj_id  FROM subject WHERE subject.id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function setSchedule($prof_id, $subj_id,  $time_in , $time_out, $chkl, $room_id){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();

        foreach($chkl as $checklist){
            $stmt = $connection->prepare("INSERT INTO subject_schedule (prof_id, subject_id, room_id, day, time_in, time_out, created_at) VALUES (?,?,?,?,?,?,?) ");
            $stmt->execute([$prof_id, $subj_id, $room_id, $checklist, $time_in , $time_out, $datetimetoday]);
        
        }
        return array('success'=>'Schedule Added','prof_id'=>$prof_id, 'subj_id'=>$subj_id);
        
       
    }

    protected function profSchedDetails($prof_id, $subj_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject_schedule.id, subject.subject_name, GROUP_CONCAT(subject_schedule.id) as ids,GROUP_CONCAT(DISTINCT(subject_schedule.day) SEPARATOR ',') as day, subject_schedule.time_in, subject_schedule.time_out,rooms.room_number FROM subject_schedule LEFT JOIN subject ON subject_schedule.subject_id = subject.id LEFT JOIN rooms ON subject_schedule.room_id = rooms.id WHERE subject_schedule.prof_id = ? and subject_schedule.subject_id = ? GROUP BY subject_schedule.room_id, subject_schedule.time_in;");
        $stmt->execute([$prof_id, $subj_id]);

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        return $data;
    }

    protected function validateSchedule($prof_id, $subj_id, $chkl, $time_in){
        $resultCheck;
        $connection = $this->dbOpen();

        foreach($chkl as $checklist){
            $stmt = $connection->prepare("SELECT day FROM subject_schedule WHERE prof_id = ? and subject_id = ? and day = ? and time_in = ?");
            $stmt->execute([$prof_id, $subj_id, $checklist, $time_in]);

            if($stmt->rowCount() > 0 ){
                $resultCheck = true;
            }
            else{
                $resultCheck = false;
            }
            return $resultCheck;
            
        }
        

    }

    protected function validateRoomAndTime($prof_id, $subj_id, $chkl, $time_in, $room_id){
        $resultCheck;
        $connection = $this->dbOpen();

        foreach($chkl as $checklist){
            $stmt = $connection->prepare("SELECT day FROM subject_schedule WHERE day = ? and time_in = ? AND room_id = ?");
            $stmt->execute([$checklist, $time_in, $room_id]);

            if($stmt->rowCount() > 0 ){
                $resultCheck = true;
            }
            else{
                $resultCheck = false;
            }
            return $resultCheck;
            
        }
        

    }

    protected function validateProfessorRoomAndTime($prof_id, $subj_id, $chkl, $time_in, $room_id){
        $resultCheck;
        $connection = $this->dbOpen();

        foreach($chkl as $checklist){
            $stmt = $connection->prepare("SELECT day FROM subject_schedule WHERE prof_id = ? and subject_id = ?  day = ? and time_in = ? AND room_id = ?");
            $stmt->execute([$prof_id, $subj_id, $checklist, $time_in, $room_id]);

            if($stmt->rowCount() > 0 ){
                $resultCheck = true;
            }
            else{
                $resultCheck = false;
            }
            return $resultCheck;
            
        }
        

    }


    protected function removeAssignedProfessor($prof_id, $subject_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM subject_schedule WHERE prof_id = ? and subject_id = ?");
        $stmt1 = $connection->prepare("DELETE FROM subject_professor WHERE professor_id = ? and subject_id = ?");
        if(!$stmt->execute([$prof_id, $subject_id])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
        if(!$stmt1->execute([$prof_id, $subject_id])){
            $stmt1 = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/subjects.php?subject_id=$subject_id");
    }

    protected function removeSubjectProfessor($prof_id, $subject_id, $time_in){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM subject_schedule WHERE prof_id = ? and subject_id = ? and time_in = ?");
        if(!$stmt->execute([$prof_id, $subject_id, $time_in])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
    }

    protected function studentsList(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM students");
        $stmt->execute();

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        return $data;
    }

    protected function insertStudents($student_id,$pro_id,$subj_id,$sched_subject){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        foreach($sched_subject as $schedules){
            $stmt = $connection->prepare("INSERT INTO professor_student (subject_id,schedule_id, professor_id, student_id, created_at) VALUES (?,?,?,?,?)");
            $stmt->execute([$subj_id,$schedules,$pro_id,$student_id,$datetimetoday]);
        }
   
        return array('success' => 'Student Added','prof_id'=>$pro_id, 'subj_id'=>$subj_id);
    }

    protected function validateStudent($student_id, $sched_subject){
        $resultCheck;
        $connection = $this->dbOpen();
    
        foreach($sched_subject as $scheds){
            $stmt = $connection->prepare("SELECT * FROM professor_student WHERE student_id = ? and schedule_id = ?");
            $stmt->execute([$student_id, $scheds]);

            if($stmt->rowCount() > 0 ){
                $resultCheck = true;
            }
            else{
                $resultCheck = false;
            }
            return $resultCheck;
        }
    }

    protected function studentsData($getscheduleid){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT professor_student.id as student_id, students.school_id, students.first_name, students.last_name FROM students LEFT JOIN professor_student ON students.id = professor_student.student_id WHERE professor_student.schedule_id = ?;");
        $stmt->execute([$getscheduleid]);
        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function deleteAssignedStudent($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM professor_student WHERE id = ?");
        if(!$stmt->execute([$id])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
        return json_encode(array("statusCode"=>200));
    }

    protected function insertRoom($room_no){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();

        $stmt = $connection->prepare("INSERT INTO rooms (room_number, created_at) VALUES (?,?) ");
       
        if(!$stmt->execute([$room_no, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
    
        return json_encode(array('success'=>'New Room added','room_number'=>$room_no, 'room_id'=>$connection->lastInsertId()));
    }

    protected function returnRooms(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM rooms");
        $stmt->execute();

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        return $data;
    }

    protected function deleteThisRoom($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM rooms WHERE id = ?");
        if(!$stmt->execute([$id])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
        return json_encode(array("statusCode"=>200, "room_id" => $id));
    }

    protected function allRooms(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM rooms");
        $stmt->execute();

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function setSchoolyear($school_year){
        $datetimetoday = date("Y-m-d H:i:s");

        $connection = $this->dbOpen();

        $stmt = $connection->prepare("INSERT INTO school_year (school_year, created_at) VALUES (?,?) ");
       
        if(!$stmt->execute([$school_year, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
    
        header("location: ../admin_page/subjects.php");
    }

    protected function getCurrentSchoolYear(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT school_year FROM school_year ORDER BY id DESC LIMIT 1");
        $stmt->execute();

        $data = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function inserStudentEntry($id, $status = 0, $has_sent = null, $datetime, $school_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO school_entry (stud_id, school_id,status, has_sent, created_at) VALUES (?,?,?,?,?)');
        $stmt->execute([$id, $school_id,$status, $has_sent, $datetime]);

    }

    protected function insertSMSEntry($id, $status = 1, $has_sent = null, $datetime, $school_id){
    

        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO sms_entry (stud_id, status, has_sent, created_at) VALUES (?,?,?,?)');
        $stmt->execute([$id,$status, $has_sent, $datetime]);

    }

    protected function getSMSdata(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM sms_entry LEFT JOIN students ON students.id = sms_entry.stud_id WHERE students.school_year  = '".$this->getCurrentSchoolYear()['school_year']."'");
        $stmt->execute();
        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

            if($total > 0){
                return $data;
            }
            else{
                return false;
             }
   

    }
}

?>