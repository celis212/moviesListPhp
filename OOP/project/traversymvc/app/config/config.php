<?php
  // DB Params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'celis212');
  define('DB_PASS', 'cesar123');
  define('DB_NAME', 'pdo-mvc');

  // App Root
  // echo __FILE__; give us the path of the URL
  // dirname eliminate the last item of the path
  //define created a constance of a value in this case approot
  define('APPROOT', dirname(dirname(__FILE__)));

  // URL Root
  define('URLROOT', 'http://localhost:81/OOP/project/traversymvc');
  //define('URLROOT', '_YOUR_URL_');

  // Site Name
  define('SITENAME', 'TraversyMVC');
  //define('SITENAME', '_YOUR_SITENAME_');

  