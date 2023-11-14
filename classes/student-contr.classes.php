<?php 


class StudentCntr extends Student{

    public function setStudents(){
        if(isset($_POST['submit'])){
            $id = $_POST['stud_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $block = $_POST['block'];
            $imageName = $_FILES["item_photo"];

         
            // var_dump($imageName);
           if($_FILES['item_photo']['size'] == 0){
                return $this->addStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year, null);
            }
            else{
                $imageFile = $this->uploadImage($imageName);
               
                return $this->addStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year, $imageFile);
            }
        }
    }

    public function updateStudents(){
        if(isset($_POST['edit_submit'])){
            $id = $_POST['student_id'];
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $block = $_POST['block'];
            $imageName = $_FILES["item_photo"];

            if($_FILES['item_photo']['size'] == 0){
                return $this->editStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year, null);
            }
            else{
                $imageFile = $this->uploadImage($imageName);
                return $this->editStudent($id, $fname, $lname, $email,  $address, $phone, $course, $year,$imageFile);
            }
           
        }
    
    }

    public function uploadImage($imageName){
        $target_dir = "../uploads/";
        $uploadErr = "";
        $target_file = $target_dir . basename($imageName["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if(file_exists($target_file)) {
            $target_file  = $target_dir .$this->random_string(). basename($imageName["name"]);
            $uploadOk = 1;
        }
        
        $check = getimagesize($imageName["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        }
        else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

     

        if($imageName["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }


        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

         // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($imageName["tmp_name"], $target_file)) {
               return $target_file;
            } else {
            echo "Sorry, there was an error uploading your file.";
            }
        }

    }

    function random_string($length = 10) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));
    
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }
    
        return $key;
    }

    public function students(){
        return $this->getStudents();
    }

    public function getStudentData($id){
        echo json_encode($this->studentData($id));
    }
    public function studentSChoolId($id){
<<<<<<< Updated upstream
        echo json_encode($this->getSchoolId($id));
=======
        $datetimetoday = date("Y-m-d H:i:s");
        $get_last_time_status = $this->getLastTimeIn($id);
        $array= $this->getSchoolId($id);
        $year = '';

        switch ($array['student_year']){
           case  '4':
                $year = '4th year';
                break;
            case '3':
                $year = '3rd year';
                break;
            case '2';
                $year = '2nd year';
                break;
            case '1';
                $year = '1st year';
                break;

        }
        if($array['school_year'] != $this->schoolYear()['school_year']){
            echo json_encode(array("error"=>"Not Enrolled!"));
        }
        else{

             if($get_last_time_status == false){
       

            try {
                echo json_encode(array("first_name"=>$array['first_name'], "last_name"=>$array['last_name'], "status"=>"Time In", "student_year" => $year, "student_course"=> $array['student_course'], "phone" => $array['parents_contact'], "address" => $array['address'], "imageFile"=>$array['imageFile'], "message_sent"=>"Success!"));
                // Send a message using the primary device.
               // $msg = sendSingleMessage("09197941914", "Dear Guardian/Parents of ".$array['first_name'] ." ".$array['last_name'].". We would like to inform you that this student has just entered the school premises at $datetimetoday", 0, null, false, null, true);
                
               $msg = sendSingleMessage($array['parents_contact'], "Dear Guardian/Parents of ".$array['first_name'] ." ".$array['last_name'].". We would like to inform you that this student has just entered the school premises at $datetimetoday");
                
            

                $this->inserStudentEntry($array['id'], 1, 1, $datetimetoday,$array['school_id']);
                $this->insertSMSEntry($array['id'], "Time In", 1, $datetimetoday,$array['school_id']);
                
             
            } catch (Exception $e) {
                echo $e->getMessage();
            }

          
        }
        else if($get_last_time_status['status'] == 1){
            $this->inserStudentEntry($array['id'], 0, 1, $datetimetoday, $array['school_id']);

            try {
                // Send a message using the primary device.
                $msg = sendSingleMessage($array['parents_contact'], "Dear Guardian/Parents of ".$array['first_name'] ." ".$array['last_name'].". We would like to inform you that this student has just exit to the school premises at $datetimetoday");
            
                // Send a message using the Device ID 1.
                // $msg = sendSingleMessage("+11234567890", "This is a test of single message.", 1);

                echo json_encode(array("first_name"=>$array['first_name'], "last_name"=>$array['last_name'], "status"=>"Time Out", "student_year" => $year, "student_course"=> $array['student_course'], "phone" => $array['parents_contact'], "address" => $array['address'], "imageFile"=>$array['imageFile'], "message_sent"=>"Success!"));
                $this->insertSMSEntry($array['id'], "Time Out", 1, $datetimetoday,$array['school_id']);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        else{
            $this->inserStudentEntry($array['id'], 1, 1, $datetimetoday,  $array['school_id']);

            try {
                // Send a message using the primary device.
                $msg = sendSingleMessage($array['parents_contact'], "Dear Guardian/Parents of ".$array['first_name'] ." ".$array['last_name'].". We would like to inform you that this student has just entered the school premises at $datetimetoday");
            
                // Send a message using the Device ID 1.
                // $msg = sendSingleMessage("+11234567890", "This is a test of single message.", 1);

                echo json_encode(array("first_name"=>$array['first_name'], "last_name"=>$array['last_name'], "status"=>"Time In", "student_year" => $year, "student_course"=> $array['student_course'], "phone" => $array['parents_contact'], "address" => $array['address'], "imageFile"=>$array['imageFile'], "message_sent"=>"Success!"));
                $this->insertSMSEntry($array['id'], "Time In", 1, $datetimetoday,$array['school_id']);
            } catch (Exception $e) {
                echo $e->getMessage();
            }


        }
      
        
 
        // if($this->checkStudent($this->getStudentData($school_id)['id'],$this->getSchedulData($subject_id)['prof_id'], $subject_id ) == false){
        //     echo json_encode(array("error" => "400"));   
        // }
        // else{
        //     if($this->attendanceExist($this->getStudentData($school_id)['id'],$this->getSchedulData($subject_id)['prof_id'], $subject_id ) == false){
        //         if ($time >= $newTime) {
        //             return $this->setStudentAttendance($this->getStudentData($school_id)['id'], $this->getSchedulData($subject_id)['prof_id'], $subject_id, 0);
                
        //         }
        //         else{
        //             return $this->setStudentAttendance($this->getStudentData($school_id)['id'], $this->getSchedulData($subject_id)['prof_id'], $subject_id, 1);
        //         }
        //     }
        //     else{
        //         echo json_encode(array("error" => "404"));
        //     }
        // }

        }
       
       
    
    }

    public function schoolYear(){
        return $this->getCurrentSchoolYear();
    }

    public function get_url($url)
{
    $cmd  = "curl --max-time 60 ";
    $cmd .= "'" . $url . "'";
    $cmd .= " > /dev/null 2>&1 &";
    exec($cmd, $output, $exit);
    return $exit == 0;
}

    public function getLastTimeIn($id){
        return $this->lastTimeIn($id);
>>>>>>> Stashed changes
    }


    public function deleteStudent($id){
        $this->removeStudent($id);
        return json_encode(array("statusCode"=>200));
    }

    public function selectLastInsertScoolId($year){
        echo json_encode($this->getId($year));
    }

    public function SMSList(){
        return $this->getSMSdata();
    }
}