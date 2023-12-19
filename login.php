<?php 
require_once 'includes/config_session_inc.php';


?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<style>
.field-icon {
  float: right;
  margin-right: 80px;
  margin-top: -50px;
  position: relative;
  z-index: 2;
  color: black;
}
.container{
  padding-top:50px;
  margin: auto;
}
</style>
<body>
        <!--top navigation-->
        <div class="bg-img"></div>
        <!-- end of Top Navigation-->

        <div class="container">
                <div class="login-card">
                        <h4><b>WELCOME!!!</b><br>  Attendance Monitoring System Of Polytechnic Institute of Tabaco.  </h4>
                                <form action="includes/login_inc.php" method="POST">
                                        <div class="form ">
                                                <h1 class="heading">Log in</h1>
                                                        <input type="email" name="email" required placeholder="enter your email">
                                                        <input type="password" name="password" required placeholder="enter your password" id="password" />
                                                        <span id="togglePassword" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                                                        <input type="submit" name="submit" value="login now" class="submit-btn">
                                                </div>
                                        
                                </form> 
                                
                </div>
        </div> 

        <script defer src="js/form.js"></script>
        <script>
              const togglePassword = document.querySelector("#togglePassword");
              const password = document.querySelector("#password");
              togglePassword.addEventListener("click", function () {
                // toggle the type attribute
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                
                // toggle the icon
                this.classList.toggle("fa-eye");
          
                });

               
        </script>
</body>
</html>