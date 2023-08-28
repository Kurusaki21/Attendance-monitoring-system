<?php
include "../classes/session.class.php";


if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    include_once '../classes/db.classes.php';
    include_once '../classes/login.classes.php';
    include_once '../classes/login-contr.classes.php';

    $login = new LoginContr($email, $pwd);

    $login->loginUser();

    
  
    // header("location: ../index.php?error=none");
}

// var_dump($_POST);
// print_r($_POST);


?>