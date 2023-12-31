<?php 

class Student extends DB{
    protected function addStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year){
            $datetimetoday = date("Y-m-d H:i:s");
            $connection = $this->dbOpen();
            $stmt = $connection->prepare('INSERT INTO students (school_id, first_name, last_name, email, address, parents_contact, student_year, student_course,created_at) VALUES (?,?,?,?,?,?,?,?,?)');
    
            if(!$stmt->execute([$id, $fname, $lname, $email,  $address, $phone, $year, $course, $datetimetoday])){
                $stmt = null;
                header("location: index.php?errors=stmtfailed");
                exit();
            }
                header("location: ../admin_page/students.php");
            
    }

    protected function getStudents(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM students");
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

}