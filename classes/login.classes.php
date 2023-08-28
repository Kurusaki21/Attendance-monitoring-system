<?php

class Login extends DB {

    protected function getUser($email, $pwd){
        $con = $this->dbOpen();
        $stmt = $con->prepare("SELECT password FROM users WHERE email = ?");
       
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

        $password = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $pass = $password[0]['password'];


        if($pwd != $pass){
            $stmt = null;
            header("Location: ../index.php?error=wrong_password");
            exit();
        } 
        elseif($pwd == $pass){
            $stmt = $con->prepare("SELECT * FROM users WHERE email = ? OR password = ?");
            if(!$stmt->execute(array($email, $pwd))){
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
                if($user['role']== 1){
                    $admin = new StartSession($user);
                    header("location: ../admin_page/index.php");
                 
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