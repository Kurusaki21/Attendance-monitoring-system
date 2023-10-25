<?php


date_default_timezone_set('Asia/Manila');

include_once '../classes/db.classes.php';
include_once '../classes/users.classes.php';
include_once '../classes/users-cntrl.classes.php';



$users = new userController();

$users->setUsers();


?>