<?php
    /**
     * redirect based on a request 
     * 
     * (ex1) login => location: URLDIRECTION/login
     * 
     * @param string $page 
     * @return string 
     */
    function redirect($page){
        header('location: ' . URLDIRECTION . $page);
    }