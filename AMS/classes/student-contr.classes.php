<?php 


class StudentCntr extends Student{

    public function setStudents(){
        if(isset($_POST['submit'])){
            $id = $_POST['stud_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $block = $_POST['block'];

           $this->addStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year);
        }
    }

    public function students(){
        return $this->getStudents();
    }

    public function getStudentData($id){
        echo json_encode($this->studentData($id));
    }

    public function deleteStudent($id){
        $this->removeStudent($id);
        return json_encode(array("statusCode"=>200));
    }

    public function selectLastInsertScoolId($year){
        echo json_encode($this->getId($year));
    }
}