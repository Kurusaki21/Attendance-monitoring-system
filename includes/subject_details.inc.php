<?php 
    date_default_timezone_set('Asia/Manila');
    include_once '../classes/db.classes.php';
    include_once '../classes/subject.classes.php';
    include_once '../classes/subject-contr.classes.php';

    $subject_details = new SubjectCntr();
    
    if(isset($_GET['subject_id'])){
        $subject = $subject_details->getSubject($_GET['subject_id']);
        $s = $subject_details->showSubjectdata($_GET['subject_id']);
    }
    
    if(isset($_POST['prof_subj_id']) && isset($_POST['subj_uid'])){
        return $subject_details->insertSchedule();
    }

    if(isset($_GET['prof_id']) && isset($_GET['subj_id'])){
        return $subject_details->getProfessorSchedule($_GET['prof_id'], $_GET['subj_id']);
    }

    if(isset($_GET['delete_prof']) && isset($_GET['subj_id'])){
      
        return $subject_details->removeProfonSchedule($_GET['delete_prof'], $_GET['subj_id']);
    }

    if(isset($_GET['delete_sched']) && isset($_GET['subj_id']) && isset($_GET['time_in'])){
      
        return $subject_details->removeSchedule($_GET['delete_sched'], $_GET['subj_id'],$_GET['time_in']);
    }
    if(isset($_POST['action']) && !empty($_POST['action'])){
        return $subject_details->getStudents();
    }

    if(isset($_POST['action_submit']) && !empty($_POST['action_submit']) ){
       return $subject_details->insertStudentSchedule($_POST['student_id'],$_POST['pro_id'],$_POST['subj_id'],$_POST['sched_subject']);
    }
    if(isset($_GET['getscheduleid'])){
        return $subject_details->students($_GET['getscheduleid']);
    }
    if(isset($_GET['delete_student'])){
        return $subject_details->delStudent($_GET['delete_student']);
    }

    $ssd = $subject_details->showAllRooms();
