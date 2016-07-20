<?php
    class UserSettings {
        private static $instance;
        private function __construct(){
            echo 'Singleton pattern create object only ones</br></br>';
        }
        private function editProfile(){            
        }
        private function addHistory(){            
        }
        public static function getInstance(){
            if(empty(self::$instance)){//static::$instance also use
                self::$instance = new UserSettings();                
            }
            return self::$instance;
        }
    }
    
    $instance = UserSettings::getInstance();
    var_dump($instance);
    var_dump($instance);
    
    /*
        1. self referes current class
        2. $this referes current object
    */