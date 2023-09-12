<?php

    class StartSession {
        private $array;

        public function __construct($array){
            $this->array = $array;

            $this->session($array);
        }

        public function session($array){
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['userdata'] = array(
                'id' => $array['id'],
                'first_name' => $array['first_name'],
                'last_name' => $array['last_name'],
                'role' => $array['role']  
            );
            return $_SESSION['userdata'];
        }
    }
    

?>