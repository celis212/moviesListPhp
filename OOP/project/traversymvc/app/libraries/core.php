<?php
/**
 * App core Class
 * creates URL & loads core controller 
 * URL FORMAT - /controller/methods/params
 * going to have properties, methods and classes
 */

    class Core{
        //traversymvc/currentController/currentMethod/params
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
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                $this->currentController = ucwords($url[0]);
                // unset index 0 of the array
                unset($url[0]);
            }

            //require the controlller 
            require_once '../app/controllers/' . $this->currentController . '.php';

            //instantiate controller class
            $this->currentController = new $this->currentController;

            if(isset($url[1])){
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])){
                    //must exist in pages to could word
                    $this->currentMethod = $url[1];
                    // Unset 1 index
                    unset($url[1]);
                }
            }
        
            // Get params
            // array_values if does values exists
            $this->params = $url ? array_values($url) : [];
    
            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            //check if is set
            if(isset($_GET['url'])){
                //return a string and eliminated the last item on the array
                //white space or special character
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
