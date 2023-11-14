<?php 

class Student extends DB{
    protected function addStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year,$imageFile, $school_year){
            $datetimetoday = date("Y-m-d H:i:s");
            $connection = $this->dbOpen();
            $stmt = $connection->prepare('INSERT INTO students (school_id, first_name, last_name, email, address, parents_contact, student_year, imageFile, student_course, school_year,created_at) VALUES (?,?,?,?,?,?,?,?,?,?,?)');
    
            if(!$stmt->execute([$id, $fname, $lname, $email,  $address, $phone, $year, $imageFile, $course,$school_year, $datetimetoday])){
                $stmt = null;
                header("location: index.php?errors=stmtfailed");
                exit();
            }
                header("location: ../admin_page/students.php");
            
    }

    protected function getStudents(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM students WHERE school_year = '".$this->getCurrentSchoolYear()['school_year']."'");
        $stmt->execute();
        $students = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $students;
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

    protected function studentData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM students WHERE id = ?");
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

    protected function removeStudent($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM students WHERE id = ?");
        $stmt->execute([$id]);
    }

    protected function getId($year){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT school_id FROM students WHERE school_id like '%$year%' ORDER BY school_id DESC LIMIT 1");
        $stmt->execute();
        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        foreach($data as $datas){
            if($total > 0){
                return $datas;
            }
            else{
                return false;
            }
        }
    }

    protected function editStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year,$imgFile){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE students SET first_name = ?, last_name = ?, email = ?, address = ?, parents_contact =?, student_course = ?, student_year = ?, imageFile = ? WHERE id = ?");
        $stmt->execute([$fname, $lname, $email,  $address, $phone, $course, $year,$imgFile, $id]);
        header("location: ../admin_page/students.php");
    }

    protected function getSchoolId($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT id, school_id, first_name, last_name, student_course,student_year, imageFile,parents_contact, student_course  FROM students WHERE school_id = ? ORDER BY school_id DESC LIMIT 1");
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

    protected function lastTimeIn($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT status,created_at FROM school_entry WHERE stud_id = ? ORDER BY created_at DESC LIMIT 1");
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

    protected function inserStudentEntry($id, $status = 0, $has_sent = null, $datetime){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO school_entry (stud_id, status, has_sent, created_at) VALUES (?,?,?,?)');
        $stmt->execute([$id, $status, $has_sent, $datetime]);

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