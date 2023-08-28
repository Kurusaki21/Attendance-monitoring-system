<?php 

class Professor extends DB{
    protected function addProf($fname, $lname, $email,  $address, $password){
        $datetimetoday = date("Y-m-d H:i:s");
        $password = md5($password);
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO professors (first_name, last_name, address, email, password,created_at) VALUES (?,?,?,?,?,?)');

        if(!$stmt->execute([$fname, $lname, $email,  $address, $password, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/professors.php");
        
    }

    protected function getProfessor(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professors");
        $stmt->execute();
        $professors = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $professors;
        }
        else{
            return false;
        }
    }

    protected function professorData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM professors WHERE id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
        
    }

    protected function removeProf($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM professors WHERE id = ?");
        $stmt->execute([$id]);
    }
}