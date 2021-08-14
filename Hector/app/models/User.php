<?php
  class User {
    /*
    * User model
    * comunicate with database
    * Execute registration and check values for username 
    * on database and validate login username and password
    */
    private $db;

    public function __construct(){
      $this->db = new Database('users');
    }

    // Register user
    public function register($data){
      //get Database
      $db_data = $this->db->getDatabase();
      $input = array(
        'username' =>$data['username'],
        'phone' => $data['phone'],
        'email' => $data['email'],
        'password' => $data['password']
      );

      //append the input to our array
      $db_data[] = $input;
      //encode back to json
      file_put_contents(APPROOT . '/database/users.json', json_encode($db_data, JSON_PRETTY_PRINT));
      
    }

    // Check if does not exist username
    public function checkUsername($username){
      //Get Database
      $db_data = $this->db->getDatabase();
      // Check in all user
      if($db_data){
        foreach($db_data as $user){
          if($user['username']==$username){
            return true;
          }
        }
      }
      return false;
    }


    // Check username and password match
    public function checkLogin($data){
      //Get Database
      $db_data = $this->db->getDatabase();
      // Check in all user
      if($db_data){
        foreach($db_data as $user){
          if($user['username']==$data['username'] && $user['password']==$data['password']){
            return true;
          }
        }
      }
      return false;
    }

  }