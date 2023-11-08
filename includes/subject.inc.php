<?php
    date_default_timezone_set('Asia/Manila');
    include_once '../classes/db.classes.php';
    include_once '../classes/subject.classes.php';
    include_once '../classes/subject-contr.classes.php';

    $subject = new SubjectCntr();

    $subject->setSubject();

    if(isset($_POST['edit_subject'])){
        $subject_name = $_POST['subject_name'];
        $subject_description = $_POST['subject_description'];
        $subj_id = $_POST['subj_id'];

        $subject->updateSubject($subject_name, $subject_description ,$subj_id);
    }

    if(isset($_GET['id'])){
        $subject->getSubjecttData($_GET['id']);

    }

    if(isset($_GET['delete_user'])){
        $subject->deleteSubject($_GET['delete_user']);
    }

    if(isset($_POST['btn_submit_professor'])){
        $subject->setAssignProfessor();
    }

    if(isset($_GET['subject_id'])){
       return $subject->selectProfessors();
    }

    if(isset($_POST['btn_schedule_submit'])){
        return $subject->insertSchedule();
    }

    if(isset($_POST['btn_room_submit'])){
        $subject->insertRoomNumber($_POST['room_no']);
    }

    if(isset($_GET['delete_rrom'])){
        $subject->deleteRoom($_GET['delete_rrom']);
    }

    if(isset($_POST['btn_submit_schoolyear'])){
        $subject->addSchoolyear($_POST['school_year']);
    }


    
