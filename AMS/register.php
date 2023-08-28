<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon"/>
        <link rel="stylesheet" href="../css/style.css">
</head> 
<body>
        <!--top navigation-->
        <img class="bg-img" src="../img/PITA.jpg" alt="Bg image">
        <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                        <a class="navbar-brand" href="#"><img src="../img/logo.png">PBAMS</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navContent" 
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navContent">
                        <ul class="navbar-nav ms-auto mb-lg-0">
                                <li class="nav-item">
                                        <a class="nav-link" href="help.html">Help</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link" href="About.html">About</a>
                                </li>
                                <li class="nav-item">
                                        <a class="nav-link active" href="more.html">More</a>
                                </li>
                        </ul>
                        </div>
                </div>
        </nav>
        <!-- end of Top Navigation-->

        <div class="container">
                <div class="card">
                <h4><b>WELCOME!!!</b><br> to Attendance Monitoring System Of Polytechnic Institute of Tabaco.  </h4>
                
                <form action="" method="post">
                        <div class="form">
                        <h1 class="heading">SIGN UP</h1>
                        <!--<?php
                        if(isset($error)){
                                foreach($error as $error){
                                echo '<span class="error-msg">'.$error.'</span>';
                                };
                        };
                        ?> -->
                        <input type="text" name="name" required placeholder="enter your name">
                        <input type="email" name="email" required placeholder="enter your email">
                        <input type="password" name="password" required placeholder="enter your password">
                        <input type="password" name="cpassword" required placeholder="confirm your password">
                        <select name="user_type">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                        </select>
                        <input type="submit" name="submit" value="Signup" class="submit-btn">
                        <p class="container 2">already have an account? <a href="login.php" ><span> Log in</span></a></p>
                        </div>
                </form>
                </div>
        </div>
        <!--<footer><h6>&copy;Copyright Reserve </h6> -->

        <script src="../js/form.js"></script>
</body>
</html>