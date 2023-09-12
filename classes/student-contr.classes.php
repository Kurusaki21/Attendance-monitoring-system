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
        echo json_encode($this->getSchoolId($id));
    }


    public function deleteStudent($id){
        $this->removeStudent($id);
        return json_encode(array("statusCode"=>200));
    }

    public function selectLastInsertScoolId($year){
        echo json_encode($this->getId($year));
    }
}