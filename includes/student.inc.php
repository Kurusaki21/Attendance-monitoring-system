<?php
    date_default_timezone_set('Asia/Manila');
    include_once '../classes/db.classes.php';
    include_once '../classes/student.classes.php';
    include_once '../classes/student-contr.classes.php';

    $student = new StudentCntr();

    $student->setStudents();

    $student->updateStudents();

    if(isset($_GET['id'])){
        $student->getStudentData($_GET['id']);
    }

    if(isset($_GET['delete_user'])){
        $student->deleteStudent($_GET['delete_user']);
    }

    if(isset($_GET['get_school_id'])){
        return $student->selectLastInsertScoolId($_GET['get_school_id']);
    }

?>