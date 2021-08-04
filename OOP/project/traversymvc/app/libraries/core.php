<?php
/**
 * App core Class
 * creates URL & loads core controller 
 * URL FORMAT - /controller/methods/params
 */

    class Core{
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            $this->getUrl();
        }

        public function getUrl(){
            echo $_GET['url'];
        }
    }
?>