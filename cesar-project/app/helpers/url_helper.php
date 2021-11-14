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
        //send headers HTTP without format 
        //location send headers call to the browser 
        header('location: ' . URLDIRECTION . $page);
    }