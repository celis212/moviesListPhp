<?php
  class User {
    public $name;
    public $age;

    // Runs when an object is created
    public function __construct($name, $age){// method constructor runs automatic
      echo 'Class ' . __CLASS__ . ' instantiated<br>';//magic constant, give the name of the current class we use 
      $this->name = $name;//set this properties 
      $this->age = $age;
    }

    public function sayHello(){
      return $this->name . ' Says Hello';
    }

    // Called when no other references to a certain object
    // Used for cleanup, closing connections, etc
    public function __destruct(){// run after run the class 
      echo 'destructor ran...';
    }
  }

  $user1 = new User('Brad', 36);//use a constructor and pass this values
  echo $user1->name . ' is ' . $user1->age . ' years old'; 
  echo '<br>';
  echo $user1->sayHello();

  echo '<br>';

  $user2 = new User('Sara', 25);
  echo $user2->name . ' is ' . $user2->age . ' years old'; 
  echo '<br>';
  echo $user2->sayHello();

  


