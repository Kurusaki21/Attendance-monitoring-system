<?php 

class AddSubject extends DB{
    protected function addSubject($subject_name, $subject_description){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare('INSERT INTO subject (subject_name, subject_description, created_at) VALUES (?,?,?)');

        if(!$stmt->execute([$subject_name, $subject_description, $datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/subjects.php?success=1");
        
    }
    protected function getSubjects(){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject.id,count(subject_professor.subject_id) as subj_id, subject.subject_name, subject.subject_description FROM subject LEFT JOIN subject_professor ON subject.id = subject_professor.subject_id GROUP BY subject.id;;");
        $stmt->execute();
        $subjects = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $subjects;
        }
        else{
            return false;
        }
    }

    protected function subjectData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM subject WHERE id = ?");
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

    protected function removeSubject($id){

        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM subject WHERE id = ?");
        $stmt->execute([$id]);
    }

    protected function editSubject($subject, $subject_description ,$subj_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("UPDATE subject SET subject_name = ?, subject_description = ? WHERE id = ?");
        $stmt->execute([$subject, $subject_description,  $subj_id]);
    }

    protected function addProfSubject($prof_id, $subj_id){
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("INSERT INTO subject_professor (professor_id, subject_id, created_at) VALUES (?,?,?) ");
        if(!$stmt->execute([$prof_id, $subj_id,$datetimetoday])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/subjects.php?success=1");
    }

    protected function getProfessorExist($prof_id, $subj_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT * FROM subject_professor WHERE professor_id = ? AND subject_id = ?");

        if(!$stmt->execute([$prof_id, $subj_id])){
            $stmt = null;

            header("location: index.php?errors=stmtfailed");
            exit();
        }
        $resultCheck;

        if($stmt->rowCount() == 0 ){
            $resultCheck = true;
        }
        else{
            $resultCheck = false;
        }
        return $resultCheck;
    }
}

?>