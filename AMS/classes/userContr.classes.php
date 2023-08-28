<?php

class UserCntr{

    public function get_userdata(){
        if(!isset($_SESSION)){
            session_start();
        }

        if(isset($_SESSION['userdata'])){
            return $_SESSION['userdata'];
        }
        else{
            return null;
        }

    
    }

}

?>