<?php
  // Define a class
  class User
  {
    // Properties (attributes)

    public $name; //acces the properti directly because is public

    // Methods (functions)

    public function sayHello()
    {
      return $this->name . ' Says Hello';// use this when we want to access a properties and methods inside the class
    }
  }

  // Instatiate a user object from the user class
  $user1 = new User(); // create a new object
  $user1->name = 'Brad';
  echo $user1->name;
  echo '<br>';
  echo $user1->sayHello();

  echo '<br>';
  // Create new user
  $user2 = new User();
  $user2->name = 'Jeff';
  echo $user2->name;
  echo '<br>';
  echo $user2->sayHello();
