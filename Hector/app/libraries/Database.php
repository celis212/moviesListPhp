<?php
    /*
    * Connect to raw JSON file use as database
    */

    class Database{
        private $db_data;
        public $name;
        public function __construct($name){
            $this->db_data = json_decode(file_get_contents(APPROOT .'/database/'.$name.'.json'),true);
        }
        public function getDatabase(){
            return $this->db_data;
        }
    }