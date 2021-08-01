<?php
  class User {
    public $name;
    public $age;
    public static $minPassLength = 6;

    public static function validatePass($pass){
      if(strlen($pass) >= self::$minPassLength){// we use self instead of this->$minPassLength because is static
        return true;
      } else {
        return false;
      }
    }
  }

  $password = 'hello1';
  if(User::validatePass($password)){
    echo 'Password valid';
  } else {
    echo 'Password NOT valid';
  }
