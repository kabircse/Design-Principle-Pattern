<?php
    class Database {
        private static $instance;
        
        public static function getInstance(){
            if(!isset(Database::$instance))
                Database::$instance = new Database();
            return Database::$instance;
        }        
        
        public function __construct(){
            //code
        }
        
        public function getQuery(){
            echo 'Select * from table';
        }
    }
    
    $db = Database::getInstance();
    $db->getQuery();
    
