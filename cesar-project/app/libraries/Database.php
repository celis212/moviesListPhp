<?php
/**
 * Conect to Databases
 * Returns the value encoded in json in an appropriate PHP type
 * 
 * Rules
 *  - the nameOfFile is automatically set by the function
 *  - it will start automatically on request.
 * 
 * @param json $db_json
 * 
 * @return  $db_json
 */

    class Database{
        private $db_json;
        public $nameOfFile;

        public function __construct($nameOfFile){
            $this->db_json = json_decode(file_get_contents(APPDIRECTION . '/database/' . $nameOfFile . '.json'),
            true);
        }

        public function getDatabase(){
            return $this->db_json;
        }
    }