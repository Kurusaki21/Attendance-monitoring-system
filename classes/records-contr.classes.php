<?php 


class recordsCntrl extends records{


    public function getRecords(){
        return $this->getAllRecords();
    }

    public function countAllStudents(){
        return $this->countStudents();
    }
    public function countAllProfessors(){
        return $this->countProfessors();
    }
    public function countAllSubAdmin(){
        return $this->countSubAdmin();
    }
    public function countAllRecords(){
        return $this->countRecords();
    }
}

?>