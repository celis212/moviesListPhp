paso uno
<?php
/**
 * performs the connection and requirement with all the files
 * 
 * Rules 
 *  - each file on the folder libraries is going to be require
 *  - the nameOfFile is automatically set by the function
 *  - the name of the file name is has to be the same of the class name
 */
    // Load Config

    require_once 'config/config.php';
    //require_once 'libraries/Database.php';

    //load libraries
    spl_autoload_register(function($nameOfFile){
        require_once 'libraries/' . $nameOfFile . '.php';
    });


    