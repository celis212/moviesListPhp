<?php
    //load libraries
    spl_autoload_register(function($nameOfFile){
        require_once 'libraries/' . $nameOfFile . '.php';
    });