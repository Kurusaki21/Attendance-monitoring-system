<?php

class Login extends DB {
    
    protected function getUser($email, $pwd){

        $con = $this->dbOpen();
        $stmt = $con->prepare("SELECT *  FROM (SELECT email, role, password FROM users UNION SELECT email,role, password from professors ) as users WHERE users.email = ?");
        if(!$stmt->execute(array($email))){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("LocationL ../index.php?error=user_not_found");
            exit();
        }
       // var_dump($stmt->fetch());
        $password = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pass1 = md5($pwd);
        $pass = $password[0]['password'];
        if($pass != $pass1){
            $stmt = null;
            header("Location: ../index.php?error=wrong_password");
            exit();
        } 

        elseif($pass1 == $pass){
            $stmt = $con->prepare("SELECT *  FROM (SELECT id, first_name, last_name ,email, role, password FROM users UNION SELECT id, first_name, last_name ,email,role, password from professors ) as users WHERE users.email = ? and password = ?");
            if(!$stmt->execute(array($email, $pass1))){
                $stmt = null;
                header("Location: ../index.php?error=stmt_failed");
                exit();
            }
            if($stmt->rowCount() == 0){
                $stmt = null;
                header("Location: ../index.php?error=user_not_found");
                exit();
            }
                
            $user = $stmt->fetch();
            if($stmt->rowCount() > 0){
                if($user['role'] == 1){
                    $admin = new StartSession($user);
                    header("location: ../admin_page/index.php");
                 
                }
                elseif($user['role'] == 2){
                    $admin = new StartSession($user);
                    header("location: ../sub-admin-page/index.php");
                }
                elseif($user['role'] == 3){
                    $admin = new StartSession($user);
                    header("location: ../professor-page/index.php");
                }
                else{
                    header("location: ../index.php");
                }
        
            }
            else{
                header("location: ../index.php?error=UserNotFound");
            }
            
   
        }

        $stmt = null;
         
    }
}


?>