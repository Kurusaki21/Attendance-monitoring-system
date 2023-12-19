<?php


class records extends DB{

    protected function getAllRecords(){

        $year = explode('-', $this->getCurrentSchoolYear()['school_year']);

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT t3.* FROM ((SELECT t1.stud_id,t11.first_name, t11.last_name, t1.status, t1.has_sent, t1.prof_id,t111.first_name as prof_fname, t111.last_name as prof_lname, t1.created_at FROM school_entry t1 LEFT JOIN students t11 ON t1.stud_id = t11.id LEFT JOIN professors t111 ON t1.prof_id = t111.id WHERE YEAR(t1.created_at) BETWEEN '".$year[0]."' AND '".$year[1]."' ) UNION ALL (SELECT t2.student_id,t22.first_name , t22.last_name, t2.is_present, t2.sched_id, t2.prof_id,t222.first_name as prof_fname, t222.last_name as prof_lname, t2.created_at FROM student_attendance t2 LEFT JOIN students t22 ON t2.student_id = t22.id LEFT JOIN professors t222 ON t2.prof_id = t222.id WHERE YEAR(t2.created_at) BETWEEN '".$year[0]."' AND '".$year[1]."' )) t3 ORDER BY t3.stud_id ASC;");
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

    protected function countStudents(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT count(id) as count FROM students WHERE school_year = '".$this->getCurrentSchoolYear()['school_year']."' ");
        $stmt->execute();
        $data = $stmt->fetch();
        $total = $stmt->rowCount();

       return $data;
    }

    protected function countProfessors(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professors WHERE school_year = '".$this->getCurrentSchoolYear()['school_year']."' ");
        $stmt->execute();
        $data = $stmt->fetch();
        $total = $stmt->rowCount();

       return $total;
    }

    protected function countSubAdmin(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM users WHERE school_year = '".$this->getCurrentSchoolYear()['school_year']."' and role = '2' ");
        $stmt->execute();
        $data = $stmt->fetch();
        $total = $stmt->rowCount();

       return $total;
    }

    protected function countRecords(){
        $year = explode('-', $this->getCurrentSchoolYear()['school_year']);
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT t3.* FROM ((SELECT t1.stud_id,t11.first_name, t11.last_name, t1.status, t1.has_sent, t1.prof_id,t111.first_name as prof_fname, t111.last_name as prof_lname, t1.created_at FROM school_entry t1 LEFT JOIN students t11 ON t1.stud_id = t11.id LEFT JOIN professors t111 ON t1.prof_id = t111.id WHERE YEAR(t1.created_at) BETWEEN '".$year[0]."' AND '".$year[1]."' ) UNION ALL (SELECT t2.student_id,t22.first_name as prof_fname, t22.last_name as prof_lname, t2.is_present, t2.sched_id, t2.prof_id,t222.first_name, t222.last_name, t2.created_at FROM student_attendance t2 LEFT JOIN students t22 ON t2.student_id = t22.id LEFT JOIN professors t222 ON t2.prof_id = t222.id WHERE YEAR(t2.created_at) BETWEEN '".$year[0]."' AND '".$year[1]."' )) t3 ORDER BY t3.stud_id ASC;");
        $stmt->execute();
        $data = $stmt->fetch();
        $total = $stmt->rowCount();

       return $total;
    }







}

?>