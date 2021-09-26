<?php
    class User {
        /*
        * User model
        * comunicate with database
        * Execute registration and check values for username 
        * on database and validate login username and password
        */
        private $db_json;//db

        public function __construct(){
            $this->db_json = new Database('dbusers');
        }

        // signup user
        public function signup($dataInfo){//data
            //get Database
            $db_data = $this->db_json->getDatabase();
            $input = array(
                'username' => $dataInfo['username'],
                'phone' => $dataInfo['phone'],
                'email' => $dataInfo['email'],
                'password' => password_hash($dataInfo['password'], PASSWORD_DEFAULT)
            );

            //append the input to our array
            $db_data[] = $input;
            //encode back to json
            file_put_contents(APPDIRECTION . '/database/dbusers.json', json_encode($db_data, JSON_PRETTY_PRINT));
        }

        // Check if does not exist username
        public function checkUsername($username){
            //Get Database
            $db_data = $this->db_json->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data as $user){
                    if($user['username'] == $username){
                        return true;
                    }
                }
            }
            return false;
        }

        // Check if does not exist email
        public function checkemail($email){
            //Get Database
            $db_data = $this->db_json->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data as $mail){
                    if($mail['email'] == $email){
                        return true;
                    }
                }
            }
            return false;
        }

        // Check username and password match
        public function checkLogin($dataInfo){
            //Get Database
            $db_data = $this->db_json->getDatabase();
            // Check in all user
            if($db_data){
                foreach($db_data as $user){
                    if($user['username'] == $dataInfo['username'] && password_verify($dataInfo['password'], 
                    $user['password'])){
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['user_name'] = $user['username'];
                        redirect('/movies');
                        return true;
                    }
                }
            }
            return false;
        }

    }