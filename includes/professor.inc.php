<?php 

date_default_timezone_set('Asia/Manila');

include_once '../classes/db.classes.php';
include_once '../classes/professor.classes.php';
include_once '../classes/professor-contr.classes.php';

$prof = new ProfessorCntr();

$prof->setProfessor();
$prof->setEdit();


if(isset($_GET['id'])){
    $prof->getProfessorData($_GET['id']);
}

if(isset($_GET['delete_user'])){
    $prof->deleteProf($_GET['delete_user']);
}
if(isset($_POST['btn_start_attendance'])){
    $prof->getSchedule($_POST['professor_schedule'], $_POST['today_date']);
}
if(isset($_GET['school_id']) && isset($_GET['subj_id'])){
    $prof->StudentAttendance($_GET['school_id'], $_GET['subj_id']);
}

