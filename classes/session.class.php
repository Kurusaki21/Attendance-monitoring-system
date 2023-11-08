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
                'role' => $array['role'],
                'account_setting' => $array['accounts_settings'],
                'subject_setting' => $array['subject_setting'],
                'records_setting' => $array['records_setting'],
                'sms_setting' => $array['sms_setting'],
                'barcode_setting' => $array['barcode_setting'] 
            );
            return $_SESSION['userdata'];
        }
    }
    

?>