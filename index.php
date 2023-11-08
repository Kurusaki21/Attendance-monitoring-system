<?php
  include "classes/userContr.classes.php";
  $userdata = new UserCntr();
  $user = $userdata->get_userdata();

  if(isset($user)){
      
    $name = $user['name'];
    $role = $user['role'];
    if(isset($role) == '1'){
        header("location: admin_page/index.php");
    }
    elseif(isset($role) == '2'){
      header("location: sub-admin-page/index.php");
    }
    else{
      header("location: professor-page/index.php");
    }
  }
  else{
    header('location: login.php');
  }

?>