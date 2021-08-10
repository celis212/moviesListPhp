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
            //print_r($this->getUrl());
            //assign to a variable 
            $url = $this->getUrl();

            //looks in controller for the firts value, if the value exist 
            //remenber that we configurate that all the infor redirects to index.php thats why we start an that position
            //ucwords capitalize the firts word
            // if the file doesnt exits currentController = pages 
            if(file_exists('../app/controllers'.ucwords($url[0]).'.php')){
                $this->currentController = ucwords($url[0]);
                // unset index 0 of the array
                unset($url[0]);
            }

            //require the controlller 
            require_once '..app/controllers'.$this->currentController.'.php';

            //instantiate controller class
            $this->currentController = new $this->currentController;
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                // return a string and eliminated the last item on the array
                $url = rtrim($_GET['url'], '/');
                // filter a variable with a special filter 
                //sanitize filter special characters
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // return an array separate with something
                $url = explode('/', $url);
                return $url;
                //echo $_GET['url'];
            }
        }
    }
