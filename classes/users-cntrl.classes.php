<?php

class userController extends users{

    public function setUsers(){
        if(isset($_POST['submit'])){
            $fname = $_POST['first_name'];
            $lname = $_POST['last_name'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $password = $_POST['password'];

           $this->addUser($fname, $lname, $email,  $address, $password);
        }
    }
}

?>