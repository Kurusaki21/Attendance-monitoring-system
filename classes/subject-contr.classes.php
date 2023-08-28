<?php

class SubjectCntr extends AddSubject{
    public function setSubject(){
        if(isset($_POST['btn_submit'])){
            $subject = $_POST['subject_name'];
            $subject_description = $_POST['subject_description'];

            $this->addSubject($subject, $subject_description);
        }
    }

    public function setAssignProfessor(){
        if(isset($_POST['btn_submit_professor'])){
            $prof_id = $_POST['select_professor'];
            $subj_id = $_POST['subj_id'];
        }
        if($this->ifProfExist($prof_id, $subj_id) == true){
            header("location: ../admin_page/subjects.php?error=professor_already_assigned");
        }
        else{
            $this->addProfSubject($prof_id, $subj_id);
        }
 
    }

    public function updateSubject($subject, $subject_description ,$subj_id){
        $this->editSubject($subject, $subject_description ,$subj_id);
        return json_encode(array("statusCode"=>200));
    }

    public function subjects(){
        return $this->getSubjects();
    }

    public function subjectsProfessor(){
        return $this->getSubjectProfessor();
    }

    public function getSubjecttData($id){
        echo json_encode($this->subjectData($id));
    }

    public function deleteSubject($id){
        $this->removeSubject($id);
        return json_encode(array("statusCode"=>200));
    }

    public function selectProfessors(){
        echo json_encode($this->getProfessors());
    }

    public function ifProfExist($prof_id, $subj_id){
        $result;

        if($this->getProfessorExist($prof_id, $subj_id)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
    
}

?>