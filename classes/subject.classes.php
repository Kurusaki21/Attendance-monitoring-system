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
        $stmt = $connection->prepare("SELECT subject.id,count(subject_professor.subject_id) as subj_id, subject.subject_name, subject.subject_description FROM subject LEFT JOIN subject_professor ON subject.id = subject_professor.subject_id GROUP BY subject.id");
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

    protected function getSubjectData($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT professors.id,professors.first_name, professors.last_name, professors.email, professors.address, subject.subject_name, subject.subject_description,subject.id as subject_id, (SELECT count(subject_id) FROM subject_professor WHERE subject_id = $id) as subj_id FROM subject_professor LEFT JOIN professors ON subject_professor.professor_id = professors.id LEFT JOIN subject ON subject.id = subject_professor.subject_id WHERE subject_professor.subject_id = $id GROUP BY professors.id");
        $stmt->execute();

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function getSubjectId($id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject.subject_name, subject.subject_description,(SELECT count(subject_id) FROM subject_professor WHERE subject_id = $id) as subj_id  FROM subject WHERE subject.id = ?");
        $stmt->execute([$id]);

        $data = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0){
            return $data;
        }
        else{
            return false;
        }
    }

    protected function setSchedule($prof_id, $subj_id,  $time_in , $time_out, $chkl){
     
        $datetimetoday = date("Y-m-d H:i:s");
        $connection = $this->dbOpen();

        foreach($chkl as $checklist){
            $stmt = $connection->prepare("INSERT INTO subject_schedule (prof_id, subject_id, day, time_in, time_out, created_at) VALUES (?,?,?,?,?,?) ");
            $stmt->execute([$prof_id, $subj_id, $checklist, $time_in , $time_out, $datetimetoday]);
        
        }
        return array('prof_id'=>$prof_id, 'subj_id'=>$subj_id);
        
       
    }

    protected function profSchedDetails($prof_id, $subj_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("SELECT subject_schedule.id, subject.subject_name, GROUP_CONCAT(subject_schedule.day) as day, subject_schedule.time_in, subject_schedule.time_out FROM subject_schedule LEFT JOIN subject ON subject_schedule.subject_id = subject.id WHERE subject_schedule.prof_id = ? and subject_schedule.subject_id = ? GROUP BY subject_schedule.time_in;");
        $stmt->execute([$prof_id, $subj_id]);

        $data = $stmt->fetchall();
        $total = $stmt->rowCount();
        return $data;
    }

    protected function validateSchedule($prof_id, $subj_id, $chkl){
        $resultCheck;
        $connection = $this->dbOpen();

        foreach($chkl as $checklist){
            $stmt = $connection->prepare("SELECT day FROM subject_schedule WHERE prof_id = ? and subject_id = ? and day = ?");
            $stmt->execute([$prof_id, $subj_id, $checklist]);

            if($stmt->rowCount() > 0 ){
                $resultCheck = true;
            }
            else{
                $resultCheck = false;
            }
            return $resultCheck;
            
        }

    }

    protected function removeAssignedProfessor($prof_id, $subject_id){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM subject_schedule WHERE prof_id = ? and subject_id = ?");
        $stmt1 = $connection->prepare("DELETE FROM subject_professor WHERE professor_id = ? and subject_id = ?");
        if(!$stmt->execute([$prof_id, $subject_id])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
        if(!$stmt1->execute([$prof_id, $subject_id])){
            $stmt1 = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
            header("location: ../admin_page/subjects.php?subject_id=$subject_id");
    }

    protected function removeSubjectProfessor($prof_id, $subject_id, $time_in){
        $connection = $this->dbOpen();
        $stmt = $connection->prepare("DELETE FROM subject_schedule WHERE prof_id = ? and subject_id = ? and time_in = ?");
        if(!$stmt->execute([$prof_id, $subject_id, $time_in])){
            $stmt = null;
            header("location: index.php?errors=stmtfailed");
            exit();
        }
    }
}

?>