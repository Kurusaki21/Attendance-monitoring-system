<?php 
date_default_timezone_set('Asia/Manila');

include_once '../classes/db.classes.php';
include_once '../classes/users.classes.php';
include_once '../classes/users-contrl.classes.php';

$users = new usersController();

$users->setUsers();


if(isset($_GET['delete_user'])){
    $users->deleteSubAdmin($_GET['delete_user']);
    
}

if(isset($_GET['userid'])){
    $users->getSubAdmin($_GET['userid']);
    
}

if(isset($_POST['btn_edit_submit'])){
   $first_name = $_POST['edit_first_name'];
   $last_name = $_POST['edit_last_name'];
   $password =$_POST['edit_user_password'];
   $email = $_POST['edit_user_email'];
   $address = $_POST['edit_user_address'];
   $sub_id = $_POST['sub_id'];

    $subadmin_sttngs = $_POST['subadmin_sttngs'];


    $users->updateSubAdmin($first_name, $last_name, $password, $email, $address, $subadmin_sttngs,$sub_id);
    
}


?>