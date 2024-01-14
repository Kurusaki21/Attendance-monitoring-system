<?php 

class Professor extends DB{
    protected function addProf($fname, $lname, $email,  $address, $password, $school_year){
        $datetimetoday = date("Y-m-d H:i:s");
        $password = md5($password);
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO professors (first_name, last_name, address, email,school_year, password,created_at) VALUES (?,?,?,?,?,?,?)');

        if(!$stmt->execute([$fname, $lname, $address,  $email, $school_year, $password, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/professors.php");
        
    }

    protected function editProfessor($id, $fname, $lname, $email,$password,  $address){
        $connection = $this->dbOpen();
        if(empty($password)){   
            $stmt = $connection->prepare("UPDATE professors SET first_name = ?, last_name = ?, email = ?, address = ? WHERE id = ?");
            if(!$stmt->execute([$fname, $lname, $email,  $address, $id])){
                $stmt = null;
                header("location: index.php?errors=stmtfailed");
                exit();
            }
                header("location: ../admin_page/professors.php?success=1");
        }
        else{
        $stmt = $connection->prepare("UPDATE professors SET first_name = ?, last_name = ?, email = ?, address = ?, password = ? WHERE id = ?");
        if(!$stmt->execute([$fname, $lname, $email,  $address,$password, $id])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/professors.php?success=1");
        }
     
    }

    protected function getProfessor(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professors WHERE school_year = '".$this->getCurrentSchoolYear()['school_year']."'");
        $stmt->execute();
        $professors = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $professors;
        }
        else{
            return false;
        }
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

    protected function professorData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professors WHERE id = ?");
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

    protected function removeProf($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM professors WHERE id = ?");
        $stmt->execute([$id]);
    }

    protected function profSchedDetails($prof_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject_schedule.id, subject.subject_name, GROUP_CONCAT(subject_schedule.id) as ids,GROUP_CONCAT(CASE WHEN subject_schedule.day = 'mon' THEN 'M' WHEN subject_schedule.day = 'tues' THEN 'T' WHEN subject_schedule.day = 'wed' THEN 'W' WHEN subject_schedule.day = 'thurs' THEN 'TH' WHEN subject_schedule.day = 'fri' THEN 'F' ELSE 'SAT' END SEPARATOR '|') as day, rooms.room_number, subject_schedule.time_in, subject_schedule.time_out FROM subject_schedule LEFT JOIN subject ON subject_schedule.subject_id = subject.id LEFT JOIN rooms ON subject_schedule.room_id = rooms.id WHERE subject_schedule.prof_id = ? GROUP BY subject_schedule.time_in, subject_id , subject_schedule.room_id ORDER BY subject_name;;");
        $stmt->execute([$prof_id]);

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        return $data;
    }

    protected function schedule($ids,$date){
        $date1 = $this->getWeekday($date);

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM subject_schedule WHERE id IN ($ids)");
        $stmt->execute();

        $data = $stmt->fetchall();
        if($date1 == 'sunday'){
            header("location: ../professor-page/index.php?error=no-schedule");
        }
        else{
            foreach($data as $datas){
                if($date1 == $datas['day']){
                    header("location: ../professor-page/barcode.php?id=".$datas['id']."");
                    exit();
                }
                elseif($date1 != $datas['day']){
                    header("location: ../professor-page/index.php?error=invalid-schedule");
                }
                else{
                    header("location: ../professor-page/index.php?error=1");
                }
              
            }
        }
   
    }
    function getWeekday($date) {
        switch (date('l', strtotime($date))) {
            case "Monday":
                return 'mon';
                break;
            case "Tuesday":
                return 'tues';
                break;
            case "Wednesday":
                return 'wed';
                break;
            case "Thursday":
                return 'thurs';
                break;
            case "Friday":
                return 'fri';
                break;
            case "Friday":
                return 'fri';
                break;
            case "Saturday":
                return 'sat';
                break;
            case "Sunday":
                return 'sunday';
                break;
          }
    }

    protected function studentId($school_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT id FROM students WHERE school_id = ?");
        $stmt->execute([$school_id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function professorId($subject_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT prof_id FROM subject_schedule WHERE id = ?");
        $stmt->execute([$subject_id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function getTime($subject_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT time_in, time_out FROM subject_schedule WHERE id = ?");
        $stmt->execute([$subject_id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function setStudentAttendance($student_id, $prof_id, $sched_id, $on_time){
        $datetimetoday = date("Y-m-d H:i:s");
      
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO student_attendance (student_id, prof_id, sched_id, is_present, on_time, created_at) VALUES (?,?,?,?,?,?)');

        if(!$stmt->execute([$student_id, $prof_id, $sched_id, '1', $on_time, $datetimetoday])){
            $stmt = null;
            echo json_encode(array("error"=>"404"));
        }
        $student_record = $this->getStudentRecord($student_id);
        echo json_encode(["first_name"=>preg_replace("~\b". preg_quote($student_record['first_name'], '~') ."\b~i", $student_record['first_name'][0] . str_repeat('*', strlen($student_record['first_name']) - 1), $student_record['first_name']), "last_name"=>substr($student_record['last_name'], 0, 1), "student_course"=>$student_record['student_course'], "student_year"=>$student_record['student_year'], "created_at"=> date('h:i a', strtotime($student_record['created_at'])), "ontime" => $student_record['on_time'], "imageFile"=>$student_record['imageFile']]);
          
    }

    protected function getStudentRecord($student_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM students LEFT JOIN student_attendance ON student_attendance.student_id = students.id WHERE students.id = ? ORDER BY student_attendance.id DESC LIMIT 1;");
        $stmt->execute([$student_id]);

        $data = $stmt->fetch();
        return $data;
    }

    protected function checkAttendance($student_id, $prof_id, $subject_id){
        $resultCheck;
        $datetimetoday = date("Y-m-d");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT created_at FROM student_attendance WHERE student_id = ? AND prof_id = ? AND sched_id = ? ORDER BY created_at DESC LIMIT 1");

        if(!$stmt->execute([$student_id, $prof_id, $subject_id])){
            $stmt = null;

            header("location: index.php?errors=stmtfailed");
            exit();
        }
        $data = $stmt->fetch();
      

        if($stmt->rowCount() >= 1 ){
           
            $new_date_format = date('Y-m-d', strtotime($data['created_at']));
            if($datetimetoday != $new_date_format){
                $resultCheck = false;
            }
            else{
                $resultCheck = true;
            }
        }
        else{
            $resultCheck = false;
        }
        return $resultCheck;
    }

    protected function professorSubject($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject.subject_name, subject.id FROM subject LEFT JOIN subject_professor ON subject_professor.subject_id = subject.id WHERE professor_id = ? ");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        return $data;
    }

    protected function checkStudent($student_id, $prof_id, $subject_id){
        $resultCheck;
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professor_student WHERE student_id = ? AND professor_id = ? AND schedule_id = ?");

        if(!$stmt->execute([$student_id, $prof_id, $subject_id])){
            $stmt = null;

            header("location: index.php?errors=stmtfailed");
            exit();
        }
        $data = $stmt->fetchall();
      

        if($stmt->rowCount() == 0 ){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function records($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT students.first_name, students.last_name, subject.subject_name, CASE WHEN subject_schedule.day = 'mon' THEN 'Monday' WHEN subject_schedule.day = 'tues' THEN 'Tuesday' WHEN subject_schedule.day = 'wed' THEN 'Wednesday' WHEN subject_schedule.day = 'thurs' THEN 'Thursday' WHEN subject_schedule.day = 'fri' THEN 'Friday' ELSE 'Saturday' END as day, subject_schedule.time_in, subject_schedule.time_out, student_attendance.is_present, student_attendance.on_time, student_attendance.created_at FROM student_attendance LEFT JOIN students ON students.id = student_attendance.student_id LEFT JOIN subject_schedule ON subject_schedule.id = student_attendance.sched_id LEFT JOIN subject ON subject_schedule.subject_id = subject.id WHERE student_attendance.prof_id = ? ORDER BY created_at DESC;");
        $stmt->execute([$id]);
        $data = $stmt->fetchall();
        return $data;
    }

    protected function countRecords($id){
        $datetimetoday = date("Y-m-d");
        $date1 = $this->getWeekday($datetimetoday);
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT *  FROM `subject_schedule` WHERE prof_id = ? group by  subject_id");
        $stmt->execute([$id]);

        $data = $stmt->rowCount();
        return $data;
    }

    protected function countStudents($id){
        $datetimetoday = date("Y-m-d");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM `professor_student` WHERE professor_id = ? GROUP BY student_id");
        $stmt->execute([$id]);

        $data = $stmt->rowCount();
        return $data;
    }
}