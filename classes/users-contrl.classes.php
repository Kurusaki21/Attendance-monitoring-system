<?php 

class usersController extends userClass {
    public function setUsers(){
        if(isset($_POST['submit'])){
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];
            $restriction = $_POST['subadmin_sttngs'];
            $school_year = $_POST['school_year'];
            $account_restriction = false;
            $subject_restriction = false;
            $records_restriction = false;
            $sms_restriction = false;
            $barcode_restriction = false;

            foreach($restriction as $rs){
                switch ($rs){
                    case 'account_sttngs':
                        $account_restriction = true;
                        break;
                    case 'subject_sttngs':
                        $subject_restriction = true;
                        break;
                    case 'records_sttngs':
                        $records_restriction = true;
                        break;
                    case 'sms_sttngs':
                        $sms_restriction = true;
                        break;
                    case 'barcode_sttngs':
                        $barcode_restriction = true;
                        break;

                }
            }


    
             $this->addUser($fname, $lname, $email,  $address, $password, $account_restriction, $subject_restriction, $records_restriction, $sms_restriction, $barcode_restriction,  $school_year);
        }
    }

    public function getListofUsers(){
        return $this->listofUsers();
    }

    public function deleteSubAdmin($id){
 
        $this->delAdmin($id);
        return json_encode(array("statusCode"=>200));
    }

    public function getSubAdmin($id){
        echo json_encode($this->subAdmin($id));
  
    }

    public function updateSubAdmin($first_name, $last_name, $password, $email, $address, $subadmin_sttngs, $id){
        $account_restriction = false;
        $subject_restriction = false;
        $records_restriction = false;
        $sms_restriction = false;
        $barcode_restriction = false;

        foreach($subadmin_sttngs as $rs){
            switch ($rs){
                case 'account_sttngs':
                    $account_restriction = true;
                    break;
                case 'subject_sttngs':
                    $subject_restriction = true;
                    break;
                case 'records_sttngs':
                    $records_restriction = true;
                    break;
                case 'sms_sttngs':
                    $sms_restriction = true;
                    break;
                case 'barcode_sttngs':
                    $barcode_restriction = true;
                    break;

            }
        }


        return $this->editSubAdmin($first_name, $last_name, $password, $email, $address, $account_restriction, $subject_restriction, $records_restriction, $sms_restriction, $barcode_restriction, $id);
    }
 
}

?>