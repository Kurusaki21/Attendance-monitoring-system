<?php 

class ProfessorCntr extends Professor{

    public function setProfessor(){
        if(isset($_POST['submit'])){
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];

           $this->addProf($fname, $lname, $email,  $address, $password);
        }
    }

    public function setEdit(){
        if(isset($_POST['edit_submit'])){
            $id = $_POST['prof_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];

           $this->editProfessor($id, $fname, $lname, $email,  $address);
        }
    }

    public function Professor(){
        return $this->getProfessor();
    }

    public function getProfessorData($id){
        echo json_encode($this->professorData($id));
    }

    public function deleteProf($id){
        $this->removeProf($id);
        return json_encode(array("statusCode"=>200));
    }


}