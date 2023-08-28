<?php 

date_default_timezone_set('Asia/Manila');

include_once '../classes/db.classes.php';
include_once '../classes/professor.classes.php';
include_once '../classes/professor-contr.classes.php';

$prof = new ProfessorCntr();

$prof->setProfessor();

if(isset($_GET['id'])){
    $prof->getProfessorData($_GET['id']);
}

if(isset($_GET['delete_user'])){
    $prof->deleteProf($_GET['delete_user']);
}


