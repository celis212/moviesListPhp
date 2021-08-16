<?php   
    // DB Params
    define('DB_HOST', 'localhost');
    define('DB_USER', 'mamp');
    define('DB_PASS', '123456');
    define('DB_NAME', 'dmvc');

    // App Root
    //__FILE__ give us the path of the actual position
    //dirname wive us the parent path
    //define give us the constance
    define('APPROOT', dirname(dirname(__FILE__)));
    // URL Root
    // we used to created the link
    define('URLROOT', 'http://localhost/traversymvc');
    // Site Name
    define('SITENAME', 'TraversyMVC');