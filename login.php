<?php 
require_once 'includes/config_session_inc.php';


?>
<!DOCTYPE html>
<html lang="en">
<?php include "header.php" ?>
<body>
        <!--top navigation-->
        <div class="bg-img"></div>
        <!-- end of Top Navigation-->

        <div class="container">
                <div class="login-card">
                        <h4><b>WELCOME!!!</b><br> to Attendance Monitoring System Of Polytechnic Institute of Tabaco.  </h4>
                                <form action="includes/login_inc.php" method="POST">
                                        <div class="form ">
                                                <h1 class="heading">Log in</h1>
                                                        <input type="email" name="email" required placeholder="enter your email">
                                                        <input type="password" name="password" required placeholder="enter your password">
                                                        
                                                        <input type="submit" name="submit" value="login now" class="submit-btn">
                                                </div>
                                        
                                </form> 
                                
                </div>
        </div> 

        <script defer src="js/form.js"></script>
</body>
</html>