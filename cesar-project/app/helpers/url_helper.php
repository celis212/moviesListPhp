<?php
    function redirect($page){
        header('location: ' . URLDIRECTION . $page);
    }