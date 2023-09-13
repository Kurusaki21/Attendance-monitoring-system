<?php 

class Professor extends DB{
    protected function addProf($fname, $lname, $email,  $address, $password){
        $datetimetoday = date("Y-m-d H:i:s");
        $password = md5($password);
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO professors (first_name, last_name, address, email, password,created_at) VALUES (?,?,?,?,?,?)');

        if(!$stmt->execute([$fname, $lname, $address,  $email, $password, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/professors.php");
        
    }

    protected function editProfessor($id, $fname, $lname, $email,  $address){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE professors SET first_name = ?, last_name = ?, email = ?, address = ? WHERE id = ?");
        if(!$stmt->execute([$fname, $lname, $email,  $address, $id])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/professors.php?success=1");
    }

    protected function getProfessor(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professors");
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
        $stmt = $connection->prepare("SELECT subject_schedule.id, subject.subject_name, GROUP_CONCAT(subject_schedule.id) as ids,GROUP_CONCAT(CASE WHEN subject_schedule.day = 'mon' THEN 'M' WHEN subject_schedule.day = 'tues' THEN 'T' WHEN subject_schedule.day = 'wed' THEN 'W' WHEN subject_schedule.day = 'thurs' THEN 'TH' ELSE 'F' END SEPARATOR '|') as day, subject_schedule.time_in, subject_schedule.time_out FROM subject_schedule LEFT JOIN subject ON subject_schedule.subject_id = subject.id WHERE subject_schedule.prof_id = ? GROUP BY subject_schedule.time_in, subject_id ORDER BY subject_name");
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
            echo 'No Schedule For this day';
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
        $student_record = $this->getStudentRecord($student_id);
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO student_attendance (student_id, prof_id, sched_id, is_present, on_time, created_at) VALUES (?,?,?,?,?,?)');

        if(!$stmt->execute([$student_id, $prof_id, $sched_id, '1', $on_time, $datetimetoday])){
            $stmt = null;
            echo json_encode(array("error"=>"404"));
        }

        echo json_encode($student_record);
          
    }

    protected function getStudentRecord($student_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$student_id]);

        $data = $stmt->fetchall();
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
      

        if($stmt->rowCount() == 0 ){
            $resultCheck = 0;
        }
        else{
            $new_date_format = date('Y-m-d', strtotime($data['created_at']));
            if($datetimetoday != $new_date_format){
                $resultCheck = 1;
            }
            else{
                $resultCheck = 0;
            }
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
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM `student_attendance` WHERE prof_id = ? AND is_present = '1' AND DATE(created_at) = ?;");
        $stmt->execute([$id, $datetimetoday]);

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